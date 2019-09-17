<?php if (!empty($organizations)) : ?>
<div class="box-section">
	<div class="container-label"><?=lang('Campus.organizations')?></div>
	<div class="campus-list">
		<?php foreach ($organizations->community as $org) :
			$id = $org->organization_id;
			?>
		<div class="col-3 p-3">
			<?= campus_logo_md($id) ?>
			<a href="<?=base_url($id)?>">
			<?=$org->slug?></a>
		</div>
		<?php endforeach ?>
	</div>
	<hr>

	<div class="container-label"><?=lang('Campus.facility')?></div>
	<div id="facilities" class="campus-list">

		<?php foreach ($organizations->facility as $org) :
			$id = $org->facility_id;
			?>
		<div>
			<div class="card">
				<?php if (is_file("./files/backgrounds/$id.jpg")) : ?>
				<img src="<?=base_url("files/backgrounds/$id.jpg")?>" height="200px" class="card-img-top" alt="">
				<?php else : ?>
				<div class="campus-placeholder" style="height:200px">
					<?= placeholder($id) ?>
				</div>
				<?php endif ?>
				<a class="card-body" href="<?=base_url($id)?>">
					<h5 class="card-title unwrap" title="<?=$org->title?>"><?=$org->title?></h5>
				</a>
			</div>
		</div>

		<?php endforeach ?>
	</div>
	<script>
	$('#facilities').slick({
		slidesToShow: Math.min($('#facilities').children().length, 3),
		slidesToScroll: 1,
		dots: true,
	});
	</script>
	<hr>

	<div class="container-label"><?=lang('Campus.services')?></div>
	<div class="campus-list">
		<?php foreach ($organizations->services as $org) :
			$id = $org->service_id;
			?>
		<div class="col-3 p-3">
			<?= campus_logo_md($id) ?>

			<a href="<?=base_url($id)?>">
			<?=$org->slug?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif ?>
