<?php $domain_name = substr(strrchr($id, "@"), 1);
if (is_file("./files/backgrounds/$domain_name.jpg")) : ?>
<div class="campus-custom-hero" style="--bg: url(<?=base_url("files/backgrounds/$domain_name.jpg")?>)">
<?php else : ?>
<div class="campus-hero">
<?php endif ?>
	<?=campus_photo($id)?>
	<h1><?=$name?></h1>
	<p><?=$id?></p>

	<?php if (!empty($weblinks)) : ?>
	<div class="row justify-content-center">
	<?php foreach ($weblinks as $link) : ?>

		<a class="btn text-light" href="<?=$link->link?>" title="<?=$link->title?>">
			<i class="<?=$link->icon?> h4"></i>
		</a>
	<?php endforeach ?>
	</div>
	<?php endif ?>
</div>
