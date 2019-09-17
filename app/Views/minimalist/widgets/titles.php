<?php if (!empty($structures)) : ?>
<div class="box-section">
<div class="container-label">Jabatan</div>
<div class="px-5 pb-3">
<?php foreach ($structures as $structure) : ?>
	<div>
		<?=$structure->structure_title?> di
		<a href="<?=base_url($structure->structure_id)?>"><?=$structure->organization_title?></a>,
		<?=date("M Y", strtotime($structure->start_date))?> sampai
		<?=$structure->end_date == "0000-00-00 00:00:00" ? "sekarang" : date("M Y", strtotime($structure->end_date))?>
	</div>
<?php endforeach ?>
</div>
</div>
<?php endif ?>
