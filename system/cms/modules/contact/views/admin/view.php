<div class="one_full">
	<section class="title">
		<h4>Detail Pesan</h4>
	</section>

	<section class="item">
		<div class="content">
				<form class="stdform " action="<?php echo uri_string(); ?>" method="post">
				<input type="text" name="d0ntf1llth1s1n" value=" " class="default-form" style="display:none" />
				<div class="tabbable">
                    <ul class="nav nav-tabs buttons-icons">
                        <li><a data-toggle="tab" href="<?php echo uri_string(); ?>#konten">Detail Pesan</a></li>
                    </ul>
                    
                    <div class="tab-content">
                        <div id="konten" class="tab-pane active">
                                 <div class="tabbable1">
                                 
                                 <div class="tab-content">
                                     <div id="indonesia" class="tab-pane active">
                                            
											  <p>
												  <label for="title">Pengirim</label>
												  <span class="input"><?php echo $contact_log->name; ?></span>
											  </p>
								  
											  <p>
												  <label for="slug">Email</label>
												  <span><?php echo $contact_log->email; ?></span>
											  </p>
								  
											  <p>
												  <label for="status">Subyek</label>
												  <div class="input"><?php echo $contact_log->subject; ?></div>
											  </p>
								  
											  <p>
												  <label for="status">Isi Pesan</label>
												  <div class="input"><?php echo nl2br($contact_log->message); ?></div>
											  </p>
											  <br/><br/>
											<p class="stdformbutton">
											   <button type="button" onclick="javascript:history.back()"><i class="iconfa-arrow-left"></i>&nbsp;&nbsp;Kembali</button>
											</p>  
											<br/>

                                         
                                      </div>
                                      
                                 </div>
                           </div>
                            
                        </div><!--tab-pane-->
						
                    </div><!--tabcontent-->
               </div><!--tabbable-->
			   </form>
		</div>
	</section>
</div>