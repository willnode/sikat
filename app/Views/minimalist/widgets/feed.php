<?php if (isset($feed->rss)) : ?>
<div class="box-section">
	<div class="container-label">Feed</div>
	<div id="rss-container" data-rss="<?=base_url("fetch_rss/$feed->account_id")?>" class="card-columns mx-2">
	</div>
	<div class="m-auto p-2 text-center"><a href="<?=$feed->referer?>">More...</a></div>
	</div>
<script src="<?=base_url('assets/js/rssburner.js')?>"></script>
<?php endif ?>