<?php if (!empty($stats)) : ?>
<div class="box-section">
<div class="campus-stat">
	<?php foreach ($stats as $key => $value) : if (!empty($value)) ?>
	<div class="text-center">
		<div class="h2"></div>
		<div class="text-center">
			<div class="h2"><?=$value?></div>
			<div><a href="<?=base_url("$key/$id")?>"><?=lang('Campus.'.$key)?></a></div>
		</div>
	</div>
	<?php endforeach ?>
</div>
</div>
<?php endif ?>
