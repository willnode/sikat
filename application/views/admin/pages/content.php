<?php
# Event, Penelitian, Prestasi, RSS Feed

echo validation_errors();

echo form_open_multipart('panel/look');

# -----------

?><div class="card"><div class="card-header">Feed</div><div class="card-body"><?php
foreach ($feeds as $feed) {
	echo "<h3>$feed->lang</h3>";
	input_text('rss', $feed->rss, 'RSS');
	input_text('referer', $feed->referer, 'Homepage');
}
?></div></div><?php

# ------------

?><div class="card"><div class="card-header">Weblink</div><div class="card-body"><?php
foreach ($weblinks as $weblink) {
	input_option('web_type', $weblink->web_type, 'Tipe', $op_weblinks);
	input_text('link', $weblink->link, 'Link');
	input_text('title', $weblink->title, 'Title');
}
?></div></div><?php

text_input('', 'Submit', '', 'submit');

echo form_close();


