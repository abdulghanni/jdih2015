<ol>
	<li>
		<label>Kategori</label>
		<div id="kategori">
		<?php echo form_dropdown('txtCat', $category, $options['txtCat']);?>
		</div>
	</li>
	<li>
		<label>Limit</label>
		<div>
		<?php echo form_input('txtLimit',$options['txtLimit'],' class="text" size="5"');?>
		</div>
	</li>
	<li>
		<label>Class</label>
		<div>
		<?php echo form_input('class', $options['class'], 'class="text" size="50"');?>
		</div>
	</li>
	 
</ol>