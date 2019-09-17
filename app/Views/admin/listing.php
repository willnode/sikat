<?php extract((array)$list) ?>
<div class="box-section p-3">
	About <?=$count?> Results &mdash;
	<?php
	$maxpage = floor($count / $pagination) + 1;
	for ($i=1; $i <= $maxpage; $i++) : ?>
	<a href="javascript:goToPage(<?=$i?>)"><?=$i?></a>
	<?php endfor ?>
</div>

<script>
	function goToPage(page) {
		const params = new URLSearchParams(window.location.search);
		params.set('page', page);
		window.location.search = params;
	}
</script>

<div class="list-group mx-2">
	<table class="table table-sm table-hover">
	<tr>
			<th>ID</th>
			<th>Judul</th>
	</tr>
	<?php foreach ($items as $item) : ?>
		<tr>
			<td><pre class='mb-0'><?=$item->$item_id?></pre></td>
			<td><?=$item->$item_title?></td>
		</tr>
	<?php endforeach ?>
</table>
</div>