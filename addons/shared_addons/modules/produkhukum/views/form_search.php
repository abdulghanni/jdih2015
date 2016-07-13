<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <p class="navbar-text">Cari Produk Hukum : </p>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="<?=site_url('produkhukum/search')?>" method="post">
        <div class="form-group">
          <input name="nomor" type="text" class="form-control" placeholder="Nomor" value="<?php echo (isset($nomor)?$nomor:''); ?>" style="width:75px !important;">
        </div>
        <div class="form-group">
          <input name="tahun" type="text" class="form-control" placeholder="Tahun" value="<?php echo (isset($tahun)?$tahun:''); ?>" style="width:75px !important;">
        </div>
        <div class="form-group">
          <input name="tentang" type="text" class="form-control" value="<?php echo (isset($tentang)?$tentang:''); ?>" placeholder="Tentang">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>