var mainMenu = (function() {

	var $listItems = $( '#mainmenu > ul > li' ),
		$menuItems = $listItems.children( 'a' ),
		$body = $( 'body' ),
		current = -1;

	function init() {
		$menuItems.on( 'click', open );
		$listItems.on( 'click', function( event ) { event.stopPropagation(); } );
	}

	function open( event ) {

		var $item = $( event.currentTarget ).parent( 'li.has-submenu' ),
			idx = $item.index();
		if($item.length != 0){
			if( current !== -1 ) {
				$listItems.eq( current ).removeClass( 'mainmenu-open' );
			}

			if( current === idx ) {
				$item.removeClass( 'mainmenu-open' );
				current = -1;
			}
			else {
				$item.addClass( 'mainmenu-open' );
				current = idx;
				$body.off( 'click' ).on( 'click', close );
			}
			return false;
		}
		else window.location = $item.find('a').attr('href');
	}

	function close( event ) {
		$listItems.eq( current ).removeClass( 'mainmenu-open' );
		current = -1;
	}

	return { init : init };

})();

(function($) {
	$(function() {
		$(".dropdown-menu > li > a.trigger").on("click",function(e){
			var current=$(this).next();
			var grandparent=$(this).parent().parent();
			if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
				$(this).toggleClass('right-caret left-caret');
			grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
			grandparent.find(".sub-menu:visible").not(current).hide();
			current.toggle();
			e.stopPropagation();
		});
		$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
			var root=$(this).closest('.dropdown');
			root.find('.left-caret').toggleClass('right-caret left-caret');
			root.find('.sub-menu:visible').hide();
		});
		
	    $('#searchDialog').on('show.bs.modal', function (e) {
	        var keyword = $('.search-input').val();
	        $('#searchDialogLabel').html('Search results for "' + keyword + '"');
	        $('#searchDialogBody').html('Loading results, please wait...');
	    });
	    
	    $('#searchDialog').on('shown.bs.modal', function (e) {
	        var keyword = $('.search-input').val();
	        if (keyword!='' && keyword!='Search') {
	            $.post(BASE_URL + "search/result", { keyword : keyword }, function(data) {
	                if (data) {
	                    $('#searchDialogBody').html(data);
	                }
	            });
	        }else{
	            $('#searchDialogBody').html('Keyword required');
	        }
	        
	    });
	});
})(jQuery);