<?php if (is_file("./files/backgrounds/$id.jpg")) : ?>
<div class="campus-custom-hero" style="--bg: url(<?=base_url("files/backgrounds/$id.jpg")?>)">
<?php else : ?>
<div class="campus-hero">
<?php endif ?>
	<?php if (is_file("./files/logos/$id.png")) : ?>
	<div class="campus-logo">
		<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
	</div>
	<?php endif ?>
	<h1><?=$name?></h1>
</div>
