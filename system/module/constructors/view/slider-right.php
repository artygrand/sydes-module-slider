
<div class="form-group">
	<label><?=t('title');?></label>
	<input type="text" name="title" value="<?=$title;?>" class="form-control" required>
</div>

<div class="form-group">
	<label><?=t('type');?></label>
	<?=H::select('settings[type]', $settings['type'], array('owl', 'nivo'), 'class="form-control"');?>
</div>

<div class="form-group">
	<label><?=t('size');?></label>
	<div class="row">
		<div class="col-xs-6">
			<input type="text" name="settings[width]" class="form-control" value="<?=$settings['width'];?>" required>
		</div>
		<div class="col-xs-6">
			<input type="text" name="settings[height]" class="form-control" value="<?=$settings['height'];?>" required>
		</div>
	</div>
</div>

<div class="form-group">
	<label><?=t('pause_time');?></label>
	<input type="text" name="settings[pause_time]" class="form-control" value="<?=$settings['pause_time'];?>" required>
</div>

<div class="form-group">
	<label><?=t('show_navigation');?></label>
	<?=H::yesNo('settings[nav]', $settings['nav']);?>
</div>

<div class="form-group">
	<label><?=t('show_dots');?></label>
	<?=H::yesNo('settings[dots]', $settings['dots']);?>
</div>
