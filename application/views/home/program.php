
<?php $this->load->view('components/campus-hero', [
	'id' => $program['program_id'],
	'name' => $program['name']
	])?>


<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div class="text-center">
			<div class="h2"><?=$stats->students?></div>
			<div><a href="<?=base_url('teachers/'.$program['program_id'])?>"><?=lang('teachers')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->students?></div>
			<div><a href="<?=base_url('students/'.$program['program_id'])?>"><?=lang('students')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->students?></div>
			<div><?=lang('alumni')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$program["accreditation"] ?: '-'?></div>
			<div><?=lang('accreditation')?></div>
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
			<?=$organization["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>