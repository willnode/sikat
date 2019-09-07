<div class="box-section">
	<div class="container-label"><?=lang('structure')?></div>
	<div class="campus-list campus-list-photo">
		<?php foreach ($structure as $member) : ?>
		<div class="col-lg-3 col-md-4 col-12 p-2">
			<div class="campus-photo mb-2">
			<?php 
			$photo = "./files/profiles/".($member->student_id ?: $member->teacher_id).".jpg";
			if (is_file($photo)) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url($photo)?>">
			<?php endif ?>
			</div>
			<div>
			<a href="<?=base_url($member->student_id ?: $member->teacher_id)?>">
			<?=$member->student_name ?: $member->teacher_name ?></a>
			</div>
			<small><?=$member->title?></small>
		</div>
		<?php endforeach ?>
	</div>
</div>