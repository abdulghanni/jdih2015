<?php if ($banners) { ?>
<?php if ($category==1) { ?>
<script type="text/javascript">

function topslider_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#topslider').jcarousel({
        auto: 3,
        scroll: 1,
        wrap: 'last',
        initCallback: topslider_initCallback
    });
});

</script>
<ul id="topslider" class="jcarousel-skin-ie7">
    <?php foreach($banners as $data => $val){?>
        <li>
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
        <a href="<?php echo $val->link_url ?>"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="500" height="372" alt="<?php echo $val->title ?>" border="0" /></a>
        <?php }else{?>
            <? if ($val->link_text!='' && $val->link_text!='#'){?>
                <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="500" height="372" alt="<?php echo $val->title ?>" border="0" usemap="#slider<?php echo $val->id ?>map" />
                <map name="slider<?php echo $val->id ?>map" id="slider<?php echo $val->id ?>map">
                <?php echo $val->link_text ?>
                </map>
            <?php }else{?>
                <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="500" height="372" alt="<?php echo $val->title ?>" border="0" />
            <?php }?>
            
        
        <?php } ?>
        </li>
    <?php } ?>
  </ul>
<?php } else if ($category==2) { ?>

<?php
    foreach($banners as $data => $val) {
        if (strpos($this->uri->uri_string(), trim($val->page))!==FALSE) {   
?>
<div class="container">
<div class="row">
    <div class="col-md-12">
        <img src="<?php echo base_url(); ?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" style="width:100%">
    </div>
</div>
</div>
 <?php } } ?>
 
<?php } else if ($category==3) { ?>
<script type="text/javascript">

function bottombanner_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

jQuery(document).ready(function() {
    jQuery('#bottombanner').jcarousel({
        auto: 3,
        scroll: 1,
        wrap: 'last',
        initCallback: bottombanner_initCallback
    });
});

</script>
<?php //print('<pre>');print_r($banners);print('</pre>'); ?>
<ul id="bottombanner" class="jcarousel-skin-bottom">
    <?php $idx=0; foreach($banners as $data => $val){?>
        <?php if ($idx%6==0) { ?><li><?php } ?>
        <?php //echo ($idx%3); ?>
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
        <a href="<?php echo $val->link_url ?>"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="140" height="60" alt="<?php echo $val->title ?>" border="0" style="margin-right: 5px" /></a>
        <?php }else{ ?>
            <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="max-width: 100%; margin-right: 5px" />
        <?php }?>
        
        <?php if ($idx%6==5) { ?></li><?php } ?>
    <?php $idx++; }?>
  </ul>
<?php } else if ($category==6) { ?>
    <?php $idx=0; foreach($banners as $data => $val){?>
        <? if ($val->link_url!='' && $val->link_url!='#'){?>
        <a href="<?php echo $val->link_url ?>" target="_blank"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="max-width: 100%; margin-right: 5px" /></a>
        <?}else{?>
            <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="300" height="200" alt="<?php echo $val->title ?>" border="0" style="margin-right: 5px" />
        <?}?>
    <?php $idx++; }?>
<?php } else if ($category==7) { ?>
    <?php $idx=0; foreach($banners as $data => $val){?>
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
            <center><a href="<?php echo $val->link_url ?>" target="_blank"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="max-width: 100%; margin-right: 5px" /></a></center>
        <?php }else{?>
            <center><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="600" height="70" alt="<?php echo $val->title ?>" border="0" style="margin-right: 5px" /></center>
        <?php }?>
    <?php $idx++; }?>

<?php } else if ($category==8) { ?>

	<div class="bx-viewport">
	<div class="bannercat8">
    <?php $idx=0; foreach($banners as $data => $val){?>
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
            <div class="bannercat8-item bx-clone">
            <a href="<?php echo $val->link_url ?>" target="_blank"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="max-width: 100%; margin-right: 5px" /></a>
            </div>
        <?php }else{?>
            <div class="bannercat8-item bx-clone">
            <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="max-width: 100%; margin-right: 5px" />
            </div>
        <?php }?>
    <?php $idx++; }?>
    </div>
    </div>
<?php } else if ($category==9) { ?>
    <div class="bannercat9">
    	<?php 
    	$idx=0; 
    	foreach($banners as $data => $val) {
    		if ($idx%3==0) { echo '<div class="row" style="margin-bottom:15px">'; }
    	?>
    	<div class="col-md-4">
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
            <div class="bannercat8-item bx-clone">
            <a href="<?php echo $val->link_url ?>" target="_blank"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="100%" alt="<?php echo $val->title ?>" border="0" style="margin-right: 5px" /></a>
            </div>
        <?php }else{ ?>
            <div class="bannercat8-item bx-clone">
            <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" width="100%" alt="<?php echo $val->title ?>" border="0" style="margin-right: 5px" />
            </div>
        <?php } ?>
        </div>
        <?php if ($idx%3==2) { echo '</div>'; } ?>
    <?php $idx++; } ?>
    </div>
<?php } else if ($category==10) { ?>
	<div class="bannercat10 row">
    	<?php 
    	$idx=0; 
    	foreach($banners as $data => $val) {
    	?>
    	<div class="col-md-12">
        <?php if ($val->link_url!='' && $val->link_url!='#'){?>
            <div class="bannercat8-item bx-clone">
            <a href="<?php echo $val->link_url ?>" target="_blank"><img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="margin-left: 0px; max-width: 100%" /></a>
            </div>
        <?php }else{ ?>
            <div class="bannercat8-item bx-clone">
            <img src="<?php echo base_url()?>uploads/default/files/<?php echo (isset($val->file->filename)?$val->file->filename:''); ?>" alt="<?php echo $val->title ?>" border="0" style="margin-left: 0px; max-width: 100%" />
            </div>
        <?php } ?>
        </div>
    	<?php $idx++; } ?>
    </div>
<?php } ?>
<?php } ?>