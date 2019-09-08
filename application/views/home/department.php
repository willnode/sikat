
<?php $this->load->view('components/campus-hero', [
	'id' => $department->department_id,
	'name' => $department->title
	])?>

<div class="container">
<div class="box-section">
	<div class="container-label"><?=lang('programs')?></div>
	<div class="campus-list">
		<?php foreach ($programs as $program) : $id = $program->program_id?>
		<div class="col-3 p-2">

			<a href="<?=base_url($id)?>">
			<?=$program->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>

<?php $this->load->view('components/campus-stats', [ 'id' => $department->department_id, 'stats' => $stats]); ?>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-organization', ['organizations' => $organizations]); ?>

<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
</div>