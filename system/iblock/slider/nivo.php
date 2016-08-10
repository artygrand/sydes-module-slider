<?php
$this->response->script[] = '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/jquery.nivo.slider.pack.min.js';
$this->response->style[] = '//cdnjs.cloudflare.com/ajax/libs/jquery-nivoslider/3.2/nivo-slider.css';
?>

<div id="slider<?=$args['show'];?>" class="nivoSlider">
	<?php foreach ($result['items'] as $i => $item) { ?>
	<a href="<?=$item['link'];?>">
		<img src="/cache/img/<?=$result['settings']['width'];?>_<?=$result['settings']['height'];?>_c<?=$item['image'];?>" alt="" title="#caption<?=$args['show'];?>-<?=$i;?>">
	</a>
	<?php } ?>
</div>
<?php foreach ($result['items'] as $i => $item) { ?>
<div id="caption<?=$args['show'];?>-<?=$i;?>" class="nivo-html-caption"><?=htmlspecialchars_decode($item['text']);?></div>
<?php } ?>

<script type="text/javascript">
$(window).load(function() {
	$('#slider<?=$args['show'];?>').nivoSlider({
		directionNav: <?=$result['settings']['nav'];?>,
		controlNav: <?=$result['settings']['dots'];?>, 
		pauseTime: <?=$result['settings']['pause_time'];?>,
	});
});
</script>
