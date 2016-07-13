<div class="prokum-kategori">
  <table class="jobs-list">
  	<tbody>
	<?php
        foreach($categories as $row => $category):
        	$class = ( ! $category->entry_count > 0) ? 'categories empty' : 'categories';			
        	$count = ' <span class="label label-success">'.$category->entry_count.'</span>';
        	print '<tr><td class="job-position"><a class="head" href="'.site_url('himpunan_perundangan/category').'/'.$category->category_id.'">'.$category->name.$count.'</a></td></tr>'.chr(13);
     	endforeach 
	 ?>
	 </tbody>
  </table>
</div>
<div class="separator">&nbsp;</div>