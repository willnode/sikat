
<div class="box-section p-3">
	About <?=$count?> Results &mdash;
	<?php
	$maxpage = floor($count / $pagination) + 1;
	for ($i=1; $i <= $maxpage; $i++) : ?>
	<a href="<?=base_url("students/$scope?page=$i")?>"><?=$i?></a>
	<?php endfor ?>
</div>

<div class="box-section">
	<div class="campus-list">
		<?php foreach ($students as $student) : ?>
		<div class="col-3 p-2">
			<a href="<?=base_url($student["student_id"])?>">
			<?=$student["name"]?></a>
		</div>
		<?php endforeach ?>
	</div>
</div>
