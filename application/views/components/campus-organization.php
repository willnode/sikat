
<div class="box-section">
	<div class="container-label"><?=lang('organizations')?></div>
	<div class="campus-list">
		<?php foreach ($organizations as $organization) :
			$id = $organization->organization_id;
			?>
		<div class="col-3 p-3">
			<div class="campus-logo-md mb-2">
			<?php if (is_file("./files/logos/$id.png")) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
			<?php endif ?>
			</div>

			<a href="<?=base_url($id)?>">
			<?=$organization->slug?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>