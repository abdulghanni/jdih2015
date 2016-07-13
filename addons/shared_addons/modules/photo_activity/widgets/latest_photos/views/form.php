<ol>
    <li class="even">
		<label>Show Title</label>
		<?php echo form_dropdown('show_title', array("0"=>"No", "1"=>"Yes"), $options['show_title']); ?>
	</li>
	<li>
		<label>Number to display</label>
		<?php echo form_input('limit', $options['limit']); ?>
	</li>
    <li class="even">
		<label>Class</label>
		<?php echo form_input('class', $options['class']); ?>
	</li>
</ol>