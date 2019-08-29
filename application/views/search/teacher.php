
<div class="box-section">
	<div class="campus-list">
		<?php foreach ($teachers as $teacher) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($teacher["teacher_id"])?>">
			<?=$teacher["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>