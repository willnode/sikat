<?php if (!empty($structure)) : ?>
<div class="box-section">
	<div class="container-label"><?=lang('Campus.events')?></div>
	<div id="events" class="campus-list">

		<?php foreach ($events as $event) :
			$id = $event->event_id;
			?>
		<div>
			<div class="card">
				<?php if (is_file("./files/pamflets/$id.jpg")) : ?>
				<img src="<?=base_url("files/pamflets/$id.jpg")?>" height="180px" class="card-img-top" alt="">
				<?php else : ?>
				<div class="campus-placeholder" style="height:180px">
					<?= placeholder($id) ?>
				</div>
				<?php endif ?>
				<a class="card-body" href="<?=base_url($id)?>">
					<h5 class="card-title unwrap" title="<?=$event->title?>"><?=$event->title?></h5>
				</a>
			</div>
		</div>

		<?php endforeach ?>
	</div>
	<script>
	$('#events').slick({
		slidesToShow: Math.min($('#events').children().length, 3),
		slidesToScroll: 1,
		dots: true,
	});
	</script>
</div>
<?php endif ?>