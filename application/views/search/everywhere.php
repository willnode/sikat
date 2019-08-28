
<div class="box-section">
	<div class="container-label">Program Studi</div>
	<div class="campus-list">
		<?php foreach ($programs as $program) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url('program/'.$program["program_id"])?>">
		<?=$program["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
