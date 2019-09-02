<?php $domain_name = substr(strrchr($id, "@"), 1);
if (is_file("./files/backgrounds/$domain_name.jpg")) : ?>
<div class="campus-custom-hero" style="--bg: url(<?=base_url("files/backgrounds/$domain_name.jpg")?>)">
<?php else : ?>
<div class="campus-hero">
<?php endif ?>
	<div class="campus-photo">
	<?php if (is_file("./files/profiles/$id.jpg")) : ?>
		<img class="w-100" alt="Logo" src="<?=base_url("files/profiles/$id.jpg")?>">
	<?php endif ?>
	</div>
	<h1><?=$name?></h1>
	<p><?=$id?></p>
</div>
