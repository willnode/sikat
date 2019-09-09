<?php include 'search-nav.php' ?>

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($programs as $program) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($program->program_id)?>">
			<?=$program->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
