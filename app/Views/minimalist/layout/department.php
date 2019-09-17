
<?= view("$theme/widgets/hero-unit" )?>

<div class="container">

<?= view("$theme/widgets/subunits", ['listTitle' => 'Campus.departments', 'subUnitId' => 'program_id' ] )?>

<?= view("$theme/widgets/stats"); ?>

<?= view("$theme/widgets/structure"); ?>

<?= view("$theme/widgets/organization"); ?>

<?= view("$theme/widgets/events"); ?>

<?= view("$theme/widgets/feed"); ?>

</div>