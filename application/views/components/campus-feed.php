<?php if (isset($feed->rss)) : ?>
<div class="box-section">
	<div class="container-label">Feed</div>
	<div id="rss-container" data-rss="<?=base_url("fetch_rss/$feed->account_id")?>" class="campus-list">
	</div>
	<p class="more"><a href="<?=$feed->referer?>">More...</a></p>
	</div>
<script src="<?=base_url('assets/js/rssburner.js')?>"></script>
<?php endif ?>