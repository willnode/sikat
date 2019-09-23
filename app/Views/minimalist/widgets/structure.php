<?php if (!empty($structure)) : ?>
<div class="box-section">
	<div class="container-label"><?=lang('Campus.structure')?></div>
	<div class="campus-list campus-list-photo">
		<?php foreach ($structure as $member) : $sid = $member->student_id ?: $member->teacher_id ?>
		<div class="col-lg-3 col-md-4 col-12 p-2">
			<?=campus_photo($sid)?>
			<div>
			<a href="<?=base_url($sid)?>">
			<?=$member->student_name ?: $member->teacher_name ?></a>
			</div>
			<small><?=$member->title?></small>
		</div>
		<?php endforeach ?>
	</div>
</div>
<?php endif ?>