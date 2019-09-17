<div class="box-section">
	<div class="row">
		<?php if (!empty($pages)) : ?>
		<div class="col-lg-4">
			<div class="container-label"><?=lang('Campus.pages')?></div>
			<div class="list-group">
			<?php foreach ($pages as $page) : ?>
			<div class="list-group-item list-group-item-action">
       			 <a href="<?=$page->link?>" class="title"><?=$page->title?></a>
		      </div>
			<?php endforeach ?>
			</div>

			<div class="container-label"><?=lang('Campus.directories')?></div>
			<div class="list-group">
			<?php foreach ($stats as $key => $value) : ?>
			<div class="list-group-item list-group-item-action">
       			 <a href="<?=base_url("$key/$id")?>" class="title"><?=lang('Campus.'.$key)?></a>
		      </div>
			<?php endforeach ?>
			</div>
		</div>
		<?php endif ?>

		<div class="col-lg-8">
			<div class="container-label"><?=lang($listTitle)?></div>
			<div class="campus-list">
				<?php foreach ($subunits as $subunit) :
				$sid = $subunit->{$subUnitId}
				?>
				<div class="col-4 p-2">
					<div class="campus-logo-md mb-2">
						<?php if (is_file("./files/logos/$sid.png")) : ?>
						<img class="w-100" alt="Logo" src="<?=base_url("files/logos/$sid.png")?>">
						<?php endif ?>
					</div>

					<a href="<?=base_url($sid)?>">
						<?=$subunit->title?>
					</a>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>