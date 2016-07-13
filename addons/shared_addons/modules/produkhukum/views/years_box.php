<h3>Produk Hukum per Tahun</h3>
<div class="row">
<?php foreach($listingsbyyear as $listing): ?>
    <div class="col-md-4">
        <a style="font-size: 12px;" href="<?=site_url('produkhukum/year')?>/<?=$listing->regyear;?>" style="font-weight:bold;font-size:14px"><b><?=$listing->regyear;?></b> <span class="label label-success"><?=$listing->total;?></span></a>
    </div>
<?php endforeach ?>	
</div>