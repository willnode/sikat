
<?= view('minimalist/widgets/hero-unit')?>

<div class="container">
<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="text-center col-md-6 m-auto">
	<?=$unit->summary?>
</div>

<?= view('minimalist/widgets/stats'); ?>

<?= view('minimalist/widgets/structure'); ?>

<?= view('minimalist/widgets/organization'); ?>

<?= view('minimalist/widgets/feed'); ?>
</div>