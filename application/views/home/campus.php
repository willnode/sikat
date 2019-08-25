
<div class="campus" id="container">
	<div>
		<h1><div class="campus-logo">Logo</div> <?=$campus['name']?></h1>
	</div>
	<div class="campus-list">
		<?php foreach ($faculties as $faculty) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url('faculty/'.$faculty['faculty_id'])?>">
			<?=$faculty['name']?>
			</a>
		</div>
		<?php endforeach ?>
	</div>
</div>
