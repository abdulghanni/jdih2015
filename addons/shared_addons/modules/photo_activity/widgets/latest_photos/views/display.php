
<!-- ======== Our Advisor ======== -->
        <section class="our_advisor">
            <div class="container">
                <div class="row">
                    <h2>Photo Kegiatan</h2>
                </div>
                <div class="row">
                 <?php
                    $idx = 1;
                    foreach($photo_album as $album):
                    ?>
                    <div class="col-md-3">
                        <div class="single-advisor">
                            <div class="img-holder">
                                <img src="images/8.jpg" alt="Awesome Image"/>
                            </div>
                            <div class="content-holder hvr-sweep-to-bottom">
                                <h4>Tim cock</h4>
                                <p>Insurance advisor</p>
                            </div>
                        </div>
                    </div>
                     <?php
        $idx++;
    endforeach; ?>
                </div>
            </div> <!-- End container -->
        </section> <!-- End our_advisor -->
<!-- ======== /Our Advisor ======== -->