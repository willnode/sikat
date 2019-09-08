
<div class="box-section p-3">
	About <?=$count?> Results &mdash;
	<?php
	$maxpage = floor($count / $pagination) + 1;
	for ($i=1; $i <= $maxpage; $i++) : ?>
	<a href="<?=base_url("departments/$scope?page=$i")?>"><?=$i?></a>
	<?php endfor ?>
</div>

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($departments as $department) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($department->department_id)?>">
			<?=$department->title?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
