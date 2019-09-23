<?php if (is_file("./files/backgrounds/$id.jpg")) : ?>
<div class="campus-custom-hero" style="--bg: url(<?=base_url("files/backgrounds/$id.jpg")?>)">
<?php else : ?>
<div class="campus-hero">
<?php endif ?>
	<div class="campus-logo">
	<?php if (is_file("./files/logos/$id.png")) : ?>
		<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
	<?php endif ?>
	</div>
	<h1 class="pb-3"><?=$title?></h1>
	<?php if (isset($slug)): ?>
	<small class="text-muted"><?=$slug?></small>
	<?php endif ?>

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
