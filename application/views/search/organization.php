
<div class="box-section p-3">
	About <?=$count?> Results &mdash;
	<?php
	$maxpage = floor($count / $pagination) + 1;
	for ($i=1; $i <= $maxpage; $i++) : ?>
	<a href="<?=base_url("organizations/$scope?page=$i")?>"><?=$i?></a>
	<?php endfor ?>
</div>

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($organizations as $organization) :
			$id = $organization["organization_id"];
			?>
		<div class="col-3 p-2">
		<div class="campus-logo-md mb-2">
		<?php if (is_file("./files/logos/$id.png")) : ?>
			<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
		<?php endif ?>
		</div>
		<a href="<?=base_url($id)?>">
			<?=$organization["slug"]?>
		</a>
		</div>
		<?php endforeach ?>
	</div>
</div>