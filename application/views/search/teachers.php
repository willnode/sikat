<?php include 'search-nav.php' ?>

<div class="box-section">
	<div class="campus-list campus-list-photo">
		<?php foreach ($teachers as $teacher) : ?>
		<div class="col-lg-3 col-md-4 col-12 p-2">
			<div class="campus-photo mb-2">
			<?php if (is_file("./files/profiles/$teacher->teacher_id.jpg")) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url("files/profiles/$teacher->teacher_id.jpg")?>">
			<?php endif ?>
			</div>
			<div>
			<a href="<?=base_url($teacher->teacher_id)?>">
			<?=$teacher->name?></a>
			</div>
		</div>
		<?php endforeach ?>
	</div>
</div>