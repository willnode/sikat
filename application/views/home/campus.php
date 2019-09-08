
<?php $this->load->view('components/campus-hero', [
	'id' => $campus->campus_id,
	'name' => $campus->title,
	'weblinks' => $weblinks
	])?>

<div class="container">
<div class="box-section">
	<div class="container-label"><?=lang('faculties')?></div>
	<div class="campus-list">
		<?php foreach ($faculties as $faculty) :
			$id = $faculty->faculty_id
			?>
		<div class="col-4 p-2">
			<div class="campus-logo-md mb-2">
			<?php if (is_file("./files/logos/$id.png")) : ?>
				<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$id.png")?>">
			<?php endif ?>
			</div>

			<a href="<?=base_url($id)?>">
			<?=$faculty->title?>
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>


<?php $this->load->view('components/campus-stats', [ 'id' => $campus->campus_id, 'stats' => $stats]); ?>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-organization', ['organizations' => $organizations]); ?>

<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>

</div>