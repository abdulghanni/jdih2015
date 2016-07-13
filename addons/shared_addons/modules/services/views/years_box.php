<TABLE width="100%" style="margin-bottom: 10px">
    <tr>
    <td align="left" valign="bottom" nowrap="nowrap"><span class="section-title">Produk Hukum per Tahun</span></td>
    <td valign="bottom" class="section-middle" width="100%">&nbsp;</td>
    </tr>
</table>
<ul>
<?php foreach($listingsbyyear as $listing): ?>
    <li style="font-size: 11px;float:left; width:33%">
        <a style="font-size: 11px;" href="<?=base_url()?>produkhukum/year/<?=$listing->regyear;?>" style="font-weight:bold;font-size:14px"><b><?=$listing->regyear;?></b> (<?=$listing->total;?>)</a>
    </li>
<?php endforeach ?>	
</ul>