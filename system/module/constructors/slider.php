<?php
/**
 * @package SyDES
 *
 * @copyright 2011-2015, ArtyGrand <artygrand.ru>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

class SliderController extends Controller{
    public $name = 'slider';

	public function install(){
		$this->registerModule();
		$this->response->notify(t('installed'));
		$this->response->redirect('?route=config/modules');
	}

	public function uninstall(){
		$this->unregisterModule();
		$this->response->notify(t('uninstalled'));
		$this->response->redirect('?route=config/modules');
	}

	public function config(){
		$this->response->redirect('?route=constructors/slider');
	}

	public function index(){
		$config = new Config('slider');
		$sliders = $config->get();
		if (!$sliders){
			$sliders = array();
		}

		$this->response->data = array(
			'content' => $this->load->view('constructors/slider-list', array(
				'sliders' => $sliders,
			)),
			'sidebar_left' => $this->getSideMenu('constructors/slider'),
			'meta_title' => t('module_slider'),
			'breadcrumbs' => H::breadcrumb(array(
				array('url' => '?route=constructors', 'title' => t('module_constructors')),
				array('title' => t('module_slider'))
			)),
		);
	}

	public function edit(){
		$data = array();
		$data['sidebar_left'] = $this->getSideMenu('constructors/slider');
		$config = new Config('slider');
		$id = isset($this->request->get['id']) ? $this->request->get['id'] : 0;
		$sliders = $config->get();
		if (!$sliders){
			$sliders = array();
		}
		$data['content'] = $this->load->view('constructors/slider-form', array(
			'slider' => $sliders[$id],
			'slider_id' => $id,
		));
		$data['form_url'] = '?route=constructors/slider/save';
		$data['sidebar_right'] = H::saveButton(DIR_SITE . $this->site . '/database.db').
			$this->load->view('constructors/slider-right', array(
				'title' => $sliders[$id]['title'],
				'settings' => $sliders[$id]['settings'],
			));
		$data['meta_title'] = t('module_slider');
		$data['breadcrumbs'] = H::breadcrumb(array(
			array('url' => '?route=constructors', 'title' => t('module_constructors')),
			array('url' => '?route=constructors/slider', 'title' => t('module_slider')),
			array('title' => t('editing'))
		));

		$this->response->data = $data;
	}

	public function add(){
		$slider = array(
			'title' => $this->request->post['title'],
			'items' => array(),
			'settings' => array(
				'type' => 'owl',
				'width' => '1140',
				'height' => '350',
				'pause_time' => '5000',
				'nav' => '1',
				'dots' => '0',
			),
		);
		$config = new Config('slider');
		$sliders = $config->get();

		if ($sliders){
			$sliders[] = $slider;
		} else {
			$sliders[1] = $slider;
		}

		$config->set($sliders)->save();

		$this->response->notify(t('saved'));
		$this->response->redirect('?route=constructors/slider/edit&id=' . count($sliders));
	}

	public function save(){
		$items = $this->request->post['slides'];

		if ($items['new_key']['image'][0] != ''){
			foreach ($items['new_key']['image'] as $i => $image){
				if ($image == '') continue;
				$items[] = array(
					'image' => $image,
					'link' => $items['new_key']['link'][$i],
					'text' => $items['new_key']['text'][$i],
				);
			}
		}
		unset($items['new_key']);

		$slider = array(
			'title' => $this->request->post['title'],
			'items' => $items,
			'settings' => $this->request->post['settings'],
		);
		$slider_id = (int)$this->request->post['id'];

		$config = new Config('slider');
		$sliders = $config->get();
		$sliders[$slider_id] = $slider;
		$config->set($sliders)->save();

		$this->response->notify(t('saved'));
		$this->response->redirect('?route=constructors/slider/edit&id=' . $slider_id);
	}

	public function delete(){
		$id = (int)$this->request->get['id'];
		$config = new Config('slider');
		$sliders = $config->get();
		if (isset($sliders[$id])){
			$this->confirm(sprintf(t('confirm_want_to_delete'), t('module_slider') . ' ' . $sliders[$id]['title']), '?route=constructors/slider');

			unset($sliders[$id]);
			$config->set($sliders)->save();
		}
		$this->response->notify(t('deleted'));
		$this->response->redirect('?route=constructors/slider');
	}

	public function cloneit(){
		$id = (int)$this->request->get['id'];

		$config = new Config('slider');
		$sliders = $config->get();
		$sliders[] = $sliders[$id];
		$config->set($sliders)->save();

		$this->response->notify(t('saved'));
		$this->response->redirect('?route=constructors/slider');
	}
}