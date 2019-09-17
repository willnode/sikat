
<?= view("$theme/widgets/hero-unit" )?>

<?= view("$theme/widgets/subunits", ['listTitle' => 'Campus.faculties', 'subUnitId' => 'faculty_id' ] )?>

<div class="container">

<?= view("$theme/widgets/stats"); ?>

<?= view("$theme/widgets/structure"); ?>

<?= view("$theme/widgets/organization"); ?>

<?= view("$theme/widgets/events"); ?>

<?= view("$theme/widgets/feed"); ?>

</div>