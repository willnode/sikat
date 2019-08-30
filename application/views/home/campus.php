
<?php $this->load->view('components/campus-hero', [
	'id' => $campus['campus_id'],
	'name' => $campus['name']
	])?>

<div class="box-section">
	<div class="container-label"><?=lang('departments')?></div>
	<div class="campus-list">
		<?php foreach ($departments as $department) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($department['department_id'])?>">
			<?=$department['name']?>
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div class="text-center">
			<div class="h2"><?=$campus['accreditation'] ?: '-'?></div>
			<div><?=lang('accreditation')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->teachers?></div>
			<div><a href="<?=base_url('teachers/'.$campus['campus_id'])?>"><?=lang('teachers')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->students?></div>
			<div><a href="<?=base_url('students/'.$campus['campus_id'])?>"><?=lang('students')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->alumni?></div>
			<div><?=lang('alumni')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->departments?></div>
			<div><?=lang('departments')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->programs?></div>
			<div><?=lang('programs')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->organizations?></div>
			<div><?=lang('organizations')?></div>
		</div>
	</div>
</div>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<div class="box-section">
	<div class="container-label"><?=lang('organizations')?></div>
	<div class="campus-list">
		<?php foreach ($organizations as $organization) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($organization["organization_id"])?>">
			<?=$organization["slug"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>