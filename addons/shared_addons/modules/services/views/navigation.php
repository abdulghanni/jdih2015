<link href="<?=base_url()?>application/modules/produkhukum/views/css/ddsmoothmenu-v.css" rel="stylesheet" type="text/css" media="all" />
<!-- Menu Holder -->
  <div id="smoothmenu1" class="ddsmoothmenu-v">
  <ul>
	<?php
        foreach($categories as $row => $category):
        	$class = ( ! $category->entry_count > 0) ? 'categories empty' : 'categories';			
        	$count = ' <small>('.$category->entry_count.')</small>';
        	print '<li><a class="head" href="produkhukum/category/'.$category->category_id.'">'.$category->name.$count.'</a></li>'.chr(13);
     	endforeach 
	 ?>
</ul>
</div>
<div class="separator">&nbsp;</div>
<a class="navhome" href="produkhukum/">Beranda Produk Hukum</a>
<a class="navhit" href="produkhukum/hit/">Hit Terbanyak</span></a>
<a class="navdownload" href="produkhukum/mostdownload/">Download Terbanyak</span></a>

