
<?php $this->load->view('components/campus-hero', [
	'id' => $organization->organization_id,
	'name' => $organization->title,
	'slug' => $organization->slug
	])?>

<?php $this->load->view('components/campus-stats', [ 'id' => $organization->organization_id, 'stats' => $stats]); ?>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
</div>