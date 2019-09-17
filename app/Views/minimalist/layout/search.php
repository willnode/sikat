
<div class="box-section p-3">
	Ditemukan sebanyak <?=$count?> Hasil &mdash;
	<?php
	$maxpage = floor($count / $pagination) + 1;
	for ($i=1; $i <= $maxpage; $i++) : ?>
	<a href="javascript:goToPage(<?=$i?>)"><?=$i?></a>
	<?php endfor ?>
</div>

<script>
	function goToPage(page) {
		const params = new URLSearchParams(window.location.search);
		params.set('page', page);
		window.location.search = params;
	}
</script>

<!---->

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($items as $item) :
			$id = $item->$id_key;
			?>
		<div class="col-xl-3 col-lg-4 col-md-6 p-2">
		<div class="card w-100 flex-row border-0">
		<?php if (!$member_mode) : ?>
			<?= campus_logo_md($id, 'mr-2') ?>
		<?php else : ?>
			<?php if (is_file("./files/profiles/$id.jpg")) : ?>
			<div class="campus-photo-md flex-shrink-0 mr-2">
				<img class="w-100" alt="Logo" src="<?=base_url("files/profiles/$id.jpg")?>">
			</div>
			<?php else : ?>
			<div class="campus-photo-md mr-2 flex-shrink-0 campus-placeholder">
				<img class="w-100" alt="Logo" src="<?=base_url("assets/images/user.png")?>">
			</div>
			<?php endif ?>
		<?php endif ?>
		<div class="d-flex align-items-center justify-content-center flex-grow-1">
		<a href="<?=base_url($id)?>">
			<?= $item->slug ?? $item->title ?? $item->name ?? '' ?>
		</a>
		</div>
		</div>
		</div>
		<?php endforeach ?>
	</div>
</div>