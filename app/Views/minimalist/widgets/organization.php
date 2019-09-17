<?php if (!empty($organizations)) : ?>
<div class="box-section">
	<div class="container-label"><?=lang('Campus.organizations')?></div>
	<div class="campus-list">
		<?php foreach ($organizations->community as $org) :
			$id = $org->organization_id;
			?>
		<div class="col-3 p-3">
			<div class="campus-logo-md mb-2">
			<?php if (is_file("./files/logos/$id.png")) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
			<?php endif ?>
			</div>

			<a href="<?=base_url($id)?>">
			<?=$org->slug?></a>
		</div>
		<?php endforeach ?>
	</div>
	<div class="container-label"><?=lang('Campus.facility')?></div>
	<div id="facilities" class="campus-list">

		<?php foreach ($organizations->facility as $org) :
			$id = $org->facility_id;
			?>
		<div>
			<div class="card">
				<?php if (is_file("./files/backgrounds/$id.jpg")) : ?>
				<img src="<?=base_url("files/backgrounds/$id.jpg")?>" height="150px" class="card-img-top" alt="">
				<?php else : ?>
				<div style="background:gainsboro;height:150px">
					<?= placeholder($org->slug) ?>
			</div>
				<?php endif ?>
				<a class="card-body" href="<?=base_url($id)?>">
					<h5 class="card-title"><?=$org->title?></h5>
				</a>
			</div>
		</div>

		<?php endforeach ?>
	</div>
	<script>
	$('#facilities').slick({
		slidesToShow: 3,
		slidesToScroll: 1,
		dots: true,
	});
	</script>
	<div class="container-label"><?=lang('Campus.unitService')?></div>
	<div class="campus-list">
		<?php foreach ($organizations->unitService as $org) :
			$id = $org->organization_id;
			?>
		<div class="col-3 p-3">
			<div class="campus-logo-md mb-2">
			<?php if (is_file("./files/logos/$id.png")) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
			<?php endif ?>
			</div>

			<a href="<?=base_url($id)?>">
			<?=$org->slug?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif ?>
