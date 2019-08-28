
<?php $this->load->view('components/campus-hero', [
	'id' => $organization['organization_id'],
	'name' => $organization['name']
	])?>


<div class="box-section">
	<div class="container-label">Bio</div>
	<div class="campus-stat">
		<div class="text-center">
			<div class="h2">B</div>
			<div><?=lang('committees')?></div>
		</div>
		<div class="text-center">
			<div class="h2">X</div>
			<div><?=lang('members')?></div>
		</div>
		<div class="text-center">
			<div class="h2">1</div>
			<div><?=lang('alumni')?></div>
		</div>
	</div>
</div>

<div class="box-section">
	<div class="container-label">Struktur</div>
</div>

<div class="box-section">
	<div class="container-label">Events</div>
</div>
