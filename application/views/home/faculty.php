
<?php $this->load->view('components/campus-hero', [
	'id' => $faculty->faculty_id,
	'name' => $faculty->title
	])?>

<div class="container">
<div class="box-section">
	<div class="container-label"><?=lang('departments')?></div>
	<div class="campus-list">
		<?php foreach ($departments as $department) : $id = $department->department_id?>
		<div class="col-3 p-2">
			<a href="<?=base_url($id)?>">
			<?=$department->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>


<?php $this->load->view('components/campus-stats', [ 'id' => $faculty->faculty_id, 'stats' => $stats]); ?>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-organization', ['organizations' => $organizations]); ?>

<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
</div>