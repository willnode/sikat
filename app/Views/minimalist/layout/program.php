
<?= view('minimalist/widgets/hero-unit', [
	'id' => $program->program_id,
	'name' => $program->title
	])?>

<div class="container">
<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="text-center col-md-6 m-auto">
	<?=$program->summary?>
</div>

<?= view('minimalist/widgets/stats', [ 'id' => $program->program_id]); ?>

<?= view('minimalist/widgets/structure'); ?>

<?= view('minimalist/widgets/organization'); ?>

<?= view('minimalist/widgets/feed'); ?>
</div>