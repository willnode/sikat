
<div class="campus" id="container">
	<h1><div class="campus-logo">Logo</div><?=$faculty["name"]?></h1>
	<div class="campus-list">
		<?php foreach ($programs as $program) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url('program/'.$program["program_id"])?>">
		<?=$program["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
