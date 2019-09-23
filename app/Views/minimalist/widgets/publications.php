<?php if (!empty($publications)) : ?>
<div class="box-section">
	<div class="container-label"><?=lang('Campus.publications')?></div>
	<div id="publications" class="list-group">
	<?php foreach ($publications as $publication) :
			$id = $publication->publication_id;
			?>
		<a href="<?=$publication->link?>" class="list-group-item list-group-item-action">
			<div class="d-flex w-100 justify-content-between">
			<h5 class="mb-1"><?=$publication->title?></h5>
			<small class="text-nowrap"><?=$publication->date?></small>
			</div>
			<small class="text-muted text-upper"><?=$publication->journal_title?></small>
		</a>
	<?php endforeach ?>
	</div>
</div>
<?php endif ?>