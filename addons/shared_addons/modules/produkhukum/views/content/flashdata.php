<?php if($flash_msg = $this->session->flashdata('msg')): ?>
<div id="flashdata">
	<span class="message_content"><?=$flash_msg?></span>
</div>
<?php endif ?>