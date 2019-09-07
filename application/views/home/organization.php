
<?php $this->load->view('components/campus-hero', [
	'id' => $organization->organization_id,
	'name' => $organization->title
	])?>


<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div class="text-center">
			<div class="h2"><?=$stats->committees?></div>
			<div><?=lang('committees')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->members?></div>
			<div><?=lang('members')?></div>
		</div>
		<div class="text-center">
			<div class="h2"><?=$stats->alumni?></div>
			<div><?=lang('alumni')?></div>
		</div>
	</div>
</div>

<?php $this->load->view('components/campus-structure', ['structure' => $structure]); ?>

<div class="box-section">
	<div class="container-label"><?=lang('events')?></div>
</div>


<?php $this->load->view('components/campus-feed', ['feed' => $feed]); ?>
