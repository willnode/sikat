
<?php $this->load->view('components/campus-hero', [
	'id' => $program->program_id,
	'name' => $program->title
	])?>

<div class="container">
<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="text-center col-md-6 m-auto">
	<?=$program->summary?>
</div>

<?php $this->load->view('components/campus-stats', [ 'id' => $program->program_id]); ?>

<?php $this->load->view('components/campus-structure'); ?>

<?php $this->load->view('components/campus-organization'); ?>

<?php $this->load->view('components/campus-feed'); ?>
</div>