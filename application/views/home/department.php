
<?php $this->load->view('components/campus-hero', [
	'id' => $department->department_id,
	'name' => $department->title
	])?>


<div class="box-section">
	<div class="container-label"><?=lang('programs')?></div>
	<div class="campus-list">
		<?php foreach ($programs as $program) : $id = $program->program_id?>
		<?php if (is_file("./files/backgrounds/$id.jpg")) : ?>
		<div class="col-3 p-2 covered" style="--bg: url(<?=base_url("files/backgrounds/$id.jpg")?>)">
		<?php else : ?>
		<div class="col-3 p-2">
		<?php endif ?>

			<a href="<?=base_url($id)?>">
			<?=$program->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div class="text-center">
			<div class="h2"><?=$stats->teachers?></div>
			<div><a href="<?=base_url('teachers/'.$department->department_id)?>"><?=lang('teachers')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->students?></div>
			<div><a href="<?=base_url('students/'.$department->department_id)?>"><?=lang('students')?></a></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->alumni?></div>
			<div><?=lang('alumni')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->programs?></div>
			<div><?=lang('programs')?></div>
		</div>
	</div>
</div>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-organization', ['organizations' => $organizations]); ?>

<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
