<div class="box-section">
	<div class="container-label"><?=lang('structure')?></div>
	<div class="campus-list">
		<?php foreach ($structure as $member) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($member["student_id"] ?: $member["teacher_id"])?>">
			<?=$member["student_name"] ?: $member["teacher_name"] ?></a>
			<small><?=$member["title"]?></small>
		</div>
		<?php endforeach ?>
	</div>
</div>