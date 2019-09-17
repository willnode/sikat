
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