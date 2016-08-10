<input type="hidden" name="id" value="<?=$slider_id;?>">

<div class="panel panel-default">
	<div class="panel-heading">
		<h4 class="panel-title"><?=t('slides');?></h4>
	</div>
	<table class="table table-hover table-condensed va-middle dtable">
		<thead>
			<tr>
				<th></th>
				<th><?=t('image');?></th>
				<th><?=t('link');?></th>
				<th><?=t('text');?></th>
			</tr>
		</thead>
		<tbody>
	<?php foreach ($slider['items'] as $i => $slide){ ?>
			<tr>
				<td></td>
				<td><input type="text" name="slides[<?=$i;?>][image]" value="<?=$slide['image'];?>" class="form-control field-image"></td>
				<td><input type="text" name="slides[<?=$i;?>][link]" value="<?=$slide['link'];?>" class="form-control"></td>
				<td><textarea name="slides[<?=$i;?>][text]"class="form-control" rows="2"><?=$slide['text'];?></textarea></td>
				
			</tr>
	<?php } ?>
		<tr>
			<td></td>
			<td><input type="text" name="slides[new_key][image][]" class="form-control input-sm field-image"></td>
			<td><input type="text" name="slides[new_key][link][]" class="form-control input-sm"></td>
			<td><textarea name="slides[new_key][text][]" class="form-control input-sm"></textarea></td>
		</tr>
		</tbody>
	</table>
</div>

<script>
$(document).ready(function(){
	$('.dtable').dtable({'append':'<?=t('tip_add_more');?>', 'remove': '<?=t('delete');?>'});

	$('[name$="image\]"]').each(function(){
		if ($(this).val()){
			$(this).parent().prev().append($('<img>').addClass('thumb').attr('src', $(this).val()));
		}
	})
})
</script>

<style>
.thumb {height: 50px;}
[name="image"] {text-align: right;}
</style>