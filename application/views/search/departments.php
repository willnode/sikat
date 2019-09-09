<?php include 'search-nav.php' ?>


<div class="box-section">
	<div class="campus-list">
		<?php foreach ($departments as $department) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($department->department_id)?>">
			<?=$department->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
