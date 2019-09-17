<?php include 'search-nav.php' ?>


<div class="box-section">
	<div class="campus-list">
		<?php foreach ($faculties as $faculty) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($faculty->faculty_id)?>">
			<?=$faculty->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
