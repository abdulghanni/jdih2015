  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#postabs-terkini">Berita Terkini</a></li>
    <li><a data-toggle="tab" href="#postabs-terpopuler">Berita Terpopuler</a></li>
  </ul>
  <div class="tab-content">
  <div id="postabs-terkini" class="tab-pane fade in active">
      <ul class="recent-posts" style="margin-top:10px">
        <?php foreach($terkini as $post_widget): ?>
			<li><?php echo anchor('blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?></li>
        <?php endforeach; ?>
      </ul>
  </div>
  <div id="postabs-terpopuler" class="tab-pane fade">
    <ul class="recent-posts" style="margin-top:10px">
        <?php foreach($terpopuler as $post_widget): ?>
			<li><?php echo anchor('blog/'.date('Y/m', $post_widget->created_on) .'/'.$post_widget->slug, $post_widget->title) ?> <span class="label label-success">Hits: <?php echo $post_widget->hits; ?></span></li>
        <?php endforeach; ?>
      </ul>
    
  </div>
  </div>