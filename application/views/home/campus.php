
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
			<div><a href="<?=base_url('alumni/'.$campus['campus_id'])?>"><?=lang('alumni')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->departments?></div>
			<div><a href="<?=base_url('departments/'.$campus['campus_id'])?>"><?=lang('departments')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->programs?></div>
			<div><a href="<?=base_url('programs/'.$campus['campus_id'])?>"><?=lang('programs')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->organizations?></div>
			<div><a href="<?=base_url('organizations/'.$campus['campus_id'])?>"><?=lang('organizations')?></a></div>
		</div>
	</div>
</div>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-organization', ['organizations' => $organizations]); ?>
