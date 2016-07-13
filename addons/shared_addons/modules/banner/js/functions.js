jQuery(function($){
	$(".upload_colorbox").colorbox({
		width:"600",
		height:"400",
		iframe:true,
		onClosed:function(){ location.reload(); }
	});
	
});

function closeBox(){
	jQuery(function($) {
		$.colorbox.close();
	});
}

(function($)
{
	$(function() {
		//update the parent
		$('select[name="category_id"]').change(function(){
			var elem = this;
			$.post(BASE_URL + 'index.php/admin/banner/ajax_select_album/' + $('select[name="category_id"]').val(), {  id: $(elem).attr('id') }, function(data){
				var select = $('select[name="album_id"]');
				$('option', select).remove();
				select.append(new Option('Select Album',''));
				jQuery.each(data, function(index, itemData) {
					$(select).append(new Option(itemData.title, itemData.id));
				});
				$.uniform.update(select); 
			}, 'json');
		});
	});
})(jQuery);