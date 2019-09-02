<?php function implode_attrs($attrs) {
	if (is_array($attrs)) {
		return implode(' ', array_map(
			function ($k, $v) { return $k .($v ? '="'. htmlspecialchars($v) .'"' : ''); },
			array_keys($attrs), $attrs
		));
	} else {
		return $attrs;
	}
} function input_alert($id) {
	return form_error($id, '<div class="row"><div class="col-md-3"></div><div class="col-md-9 alert alert-danger"><i class="fa fa-exclamation-triangle mr-2"></i> ', '</div></div>');
} function alert_input($id) {
	return form_error($id, '<div class="row"><div class="col-md-12 alert alert-danger"><i class="fa fa-exclamation-triangle mr-2"></i> ', '</div></div>');
} function input_label($id, $value, $label) { ?>
	<div class="form-group row">
		<label class="col-md-3 col-form-label"><?=$label?></label>
		<div class="col-md-9">
			<div class="form-control" style="height: inherit;" id="<?=$id?>" data-raw="<?=$value?>"><?=$value?></div>
		</div>
	</div>
<?php } function input_text($id, $value, $label, $type="text", $attrs = '') { ?>
	<?php if ($type != 'hidden') : ?>
	<div class="form-group row">
		<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
		<div class="col-md-9">
			<input class="form-control" type="<?=$type?>" id="<?=$id?>" name="<?=$id?>" value="<?=set_value($id, htmlspecialchars($value), false)?>" <?= implode_attrs($attrs) ?>>
		</div>
	</div>
	<?= input_alert($id); ?>
	<?php else : ?>
		<input hidden id="<?=$id?>" name="<?=$id?>" value="<?=$value?>" <?= implode_attrs($attrs) ?>>
	<?php endif ?>
<?php } function text_input($id, $value, $label, $type="text", $attrs = '') { ?>
	<?php if ($type != 'hidden') : ?>
	<div class="form-group row">
		<div class="col-md-12">
			<input class="form-control" type="<?=$type?>" placeholder="<?=$label?>" id="<?=$id?>" name="<?=$id?>" value="<?=$value?>" <?= implode_attrs($attrs) ?>>
		</div>
	</div>
	<?= alert_input($id); ?>
	<?php else : ?>
		<input hidden id="<?=$id?>" name="<?=$id?>" value="<?=$value?>" <?= implode_attrs($attrs) ?>>
	<?php endif ?>
<?php } function text($value, $type="text") { ?>
	<div class="form-group row">
		<div class="col-md-12">
			<input class="form-control" type="<?=$type?>" value="<?=$value?>" disabled>
		</div>
	</div>
<?php } function input_area($id, $value, $label, $attrs = '') { ?>
	<div class="form-group row">
		<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
		<div class="col-md-9">
			<textarea class="form-control" id="<?=$id?>" name="<?=$id?>" <?= implode_attrs($attrs) ?>><?=set_value($id, htmlspecialchars($value), false)?></textarea>
		</div>
	</div>
	<?= input_alert($id); ?>
<?php }  function input_html($id, $value, $label, $attrs = '') { ?>
	<div class="form-group row">
		<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
		<div class="col-md-9">
			<textarea class="form-control" id="<?=$id?>" name="<?=$id?>" <?= implode_attrs($attrs) ?>><?=set_value($id, htmlspecialchars($value), false)?></textarea>
		</div>
	</div>
<script>
$(document).ready(function() {
	$('#<?=$id?>').summernote({
		minHeight: 300,
		toolbar: [
			// [groupName, [list of button]]
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough', 'superscript', 'subscript']],
			['fontsize', ['fontsize', 'color']],
			['para', ['ul', 'ol']],
			['height', ['paragraph', 'height']],
			['insert', ['picture', 'link', 'video', 'table', 'hr']],
			['height', ['codeview', 'fullscreen', 'help']],
		], callbacks: {
			onImageUpload: function(files) {
				data = new FormData();
				data.append("file", files[0]);
				$.ajax({
					data: data,
					type: "POST",
					url: "<?=base_url('web/img/upload')?>",
					cache: false,
					contentType: false,
					processData: false,
					success: function(url) {
						$('#<?=$id?>').summernote('insertImage', url);
					}
				});
			}
		},
	});
	function sendFile(file, editor, welEditable) {

	}
});
</script>
<?php } function input_check($id, $checked, $label) { ?>
	<div class="form-group row">
		<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
		<div class="col-md-9">
			<label class="switch switch-label switch-pill switch-primary switch-lg">
				<input class="switch-input" type="checkbox" <?=$checked ? 'checked' : ''?> id="<?=$id?>" name="<?=$id?>" value="1" >
				<span class="switch-slider" data-checked="✓" data-unchecked="✕"></span>
			</label>
		</div>
	</div>
<?php } function white_img() {
			return 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=';
	  } function input_img($id, $folder, $file, $label, $attrs = '') { ?>

<div class="form-group row">
	<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
	<div class="col-md-9">
		<div class="form-control h-auto">
		<img src='<?= $file ? base_url("$folder/$file") :
		white_img() ?>' id="<?=$id?>_thumb" height='100' class='mr-2'>
		<input class="mt-2" type="file" id="<?=$id?>" name="<?=$id?>"  <?= implode_attrs($attrs) ?>>
		<script>
		$("#<?=$id?>").on('change', function() {
			if (this.files && this.files[0]) {
				var reader = new FileReader();

				reader.onload = function(e) {
					$('#<?=$id?>_thumb').attr('src', e.target.result);
				}

				reader.readAsDataURL(this.files[0]);
				}
		});
		</script>
		</div>
	</div>
</div>
<?php } function input_file($id, $file, $label) { ?>
<div class="form-group row">
	<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
	<div class="col-md-9">
		<input class="form-control h-auto" type="file" id="<?=$id?>" name="<?=$id?>">
	</div>
</div>
<?php } function input_option($id, $selected, $label, $values, $attrs = '') { ?>
<div class="form-group row">
	<label class="col-md-3 col-form-label" for="<?=$id?>"><?=$label?></label>
	<div class="col-md-9">
		<select class="form-control" id="<?=$id?>" name="<?=$id?>" <?= implode_attrs($attrs) ?>>
			<?php foreach ($values as $k => $v): ?>
			<option value="<?=$k?>" <?=$selected == $k ? 'selected' : ''?>>
			<?=$v?>
			</option>
			<?php endforeach?>
		</select>
	</div>
</div>
<?php } function input_buttons($buttons, $classes = 'btn-group m-auto') { ?>
	<div class="<?= $classes ?>">
	<?php foreach ($buttons as $item): ?>
		<a class="btn <?=$item->style?>" <?php if (isset($item->onclick)) { ?>onclick="<?=$item->onclick?>"<?php } ?> <?php if (isset($item->link)) { ?>href="<?=base_url($item->link)?>"<?php } ?> <?php if (isset($item->alt)) { ?>alt="<?=$item->alt?>"<?php } ?>
			<?php if (isset($item->confirm)) { ?>onclick="return confirm(`<?=$item->confirm?>`);"<?php } ?> <?php if (isset($item->target)) { ?>target="<?=$item->target?>"<?php } ?>>
			<i class="fa <?=$item->icon?>"></i>
			<?php if (isset($item->text)) { ?><span class="ml-2"><?=$item->text?></span><?php } ?>
		</a>
		<?php endforeach?>
	</div>
<?php } function input_buttons_pageddinas($folder, $stts, $id) {

	input_buttons([
		(object)[ 'alt' => 'Lihat', 'icon' => 'fa-external-link', 'style' => 'btn-primary',
			'link' => "web/$folder/detail/$id", 'target' => '_blank'],
		(object)[ 'alt' => ($stts ? 'Sembunyikan' : 'Tampilkan'), 'icon' => $stts ? 'fa-eye-slash' : 'fa-eye',
		'style' => ($stts ? 'btn-outline-warning' : 'btn-warning'),
		'link' => "web/$folder/".($stts ? 'hide' : 'unhide')."/$id" ],
		(object)[ 'alt' => 'Edit', 'icon' => 'fa-edit', 'style' => 'btn-outline-success',
			'link' => "web/$folder/edit/$id"],
		(object)[ 'alt' => 'Hapus', 'icon' => 'fa-trash', 'style' => 'btn-outline-danger',
			'link' => "web/$folder/delete/$id",
			'confirm' => 'Anda yakin ingin menghapus item tersebut?'],
	]);

} function input_buttons_editdel($edit_link, $del_link) {

	input_buttons([
		(object)[ 'alt' => 'Edit', 'icon' => 'fa-edit', 'style' => 'btn-outline-success',
			'link' => $edit_link],
		(object)[ 'alt' => 'Hapus', 'icon' => 'fa-trash', 'style' => 'btn-outline-danger',
			'link' => $del_link,
			'confirm' => 'Anda yakin ingin menghapus item tersebut?'],
	]);

} function option_dinas($db) {
	$opts[-1] = 'Tak Ditentukan';

	 foreach ($db->get('super__bidang')->result() as $x):
         $opts[$x->id_super_bidang] = "Dinas ".$x->bidang;
	 endforeach;

	 return $opts;
 } function submit_buttons($back) { ?>
	<div class="text-center">
		<input type="submit" class="btn btn-primary px-5" value="Simpan">
		<a class="btn btn-outline-secondary px-5" href="<?=$back?>">Kembali</a>
	</div>
<?php } function buttons_submit($back) { ?>
	<div>
		<input type="submit" class="btn btn-primary px-5" value="Simpan">
		<a class="btn btn-outline-secondary px-5" href="<?=$back?>">Kembali</a>
	</div>
<?php } function base_or_absolute_url($uri) {
	if ( ! preg_match('#^(\w+:)?//#i', $uri)) {
		$uri = base_url($uri);
	}
	return $uri;
}
