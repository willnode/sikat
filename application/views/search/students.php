<?php include 'search-nav.php' ?>

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($students as $student) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($student->student_id)?>">
			<?=$student->name?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
