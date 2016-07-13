<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <p class="navbar-text">Cari Undang-undang : </p>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" action="<?=site_url('himpunan_perundangan/search')?>" method="post">
        <div class="form-group">
          <input name="nomor" type="text" class="form-control" placeholder="Nomor" style="width:75px !important;">
        </div>
        <div class="form-group">
          <input name="tahun" type="text" class="form-control" placeholder="Tahun" style="width:75px !important;">
        </div>
        <div class="form-group">
          <input name="tentang" type="text" class="form-control" placeholder="Tentang">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>