<?php
$this->response->script[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js';
$this->response->style[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.carousel.min.css';
$this->response->style[] = '//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/assets/owl.theme.default.min.css';
?>
<div id="slider<?=$args['show'];?>" class="owl-carousel owl-theme">
	<?php foreach ($result['items'] as $item) { ?>
	<?php if ($item['link']) { ?><a href="<?=$item['link'];?>"><?php } else { ?><div><?php } ?>
		<img src="/cache/img/<?=$result['settings']['width'];?>_<?=$result['settings']['height'];?>_c<?=$item['image'];?>" alt="">
		<span><?=htmlspecialchars_decode($item['text']);?></span>
	<?php if ($item['link']) { ?></a><?php } else { ?></div><?php } ?>
	<?php } ?>
</div>

<script type="text/javascript">
$(window).load(function() {
	$('#slider<?=$args['show'];?>').owlCarousel({
		loop: true,
		items: 1,
		nav: <?=$result['settings']['nav'];?>,
		dots: <?=$result['settings']['dots'];?>,
		autoplayTimeout: <?=$result['settings']['pause_time'];?>,
		autoplayHoverPause: true,
		autoplay: true,
	});
});
</script>
