var img_float;

function insertImage(formfile, file, formid, id)
{
   window.parent.document.getElementById(formid).value = id;
   window.parent.document.getElementById(formfile).value = file;
   window.parent.closeBox();
}

// By default, insert (which will also replace)
var replace_html = null;

(function($)
{
	$(function()
	{
        //tooltip
		$('#images-container img').hover( function() {
		    $(this).attr('title', 'Click to insert image');
		});

        //cue up uniform
        $('select, #upload-box input[type=text], input[type=file], input[type=submit]').livequery(function() {
            $.uniform && $(this).uniform();
        });


        /**
         * left files navigation handler
         *  - handles loading of different folders
         *  - manipulates dom classes etc
         */
        $('#files-nav li a').live('click', function(e) {

            e.preventDefault();

            var href_val = $(this).attr('href');

            //remove existing 'current' classes
            $('#files-nav li').removeClass('current');

            //add class to click anchor parent
            $(this).parent('li').addClass('current');

			//remove any notifications
			$( 'div.notification' ).fadeOut('fast');

			if($(this).attr('title') != 'upload')
			{
				$('#files_right_pane').load(href_val + ' #files-wrapper', function() {
					$(this).children().fadeIn('slow');
				});
			}
			else
			{
				var box = $('#upload-box');
				if (box.is( ":visible" ))
				{
					// Hide - slide up.
					box.fadeOut( 800 );
				}
				else
				{
					// Show - slide down.
					box.fadeIn( 800 );

				}
			}
        });

		$( '#upload-box span.close' ).live('click', function() {

			$( '#upload-box' ).fadeOut( 800, function() {
				$(this).find('input[type=text], input[type=file]').val('');
				$.uniform.update('input[type=file]');
			});

		});

        $('select[name=parent_id]').live('change', function() {
            var folder_id = $(this).val();
			var controller = $(this).attr('title');
            var href_val = 'admin_' + controller + '/index/' + folder_id;
            $('#files_right_pane').load(href_val + ' #files-wrapper', function() {
				$(this).children().fadeIn('slow');
				var class_exists = $('#folder-id-' + folder_id).html();
				$( 'div.notification' ).fadeOut('fast');
				if(class_exists !== null)
				{
					$('#files-nav li').removeClass('current');
					$('li#folder-id-'+folder_id).addClass('current');
				}

            });
        })

        //slider

        $( "#slider" ).livequery(function() {
			$(this).fadeIn('slow');
			$(this).slider({
				value:200,
				min: 50,
				max: 800,
				step: 1,
				slide: function( event, ui ) {
					$( "#insert_width" ).val( ui.value + 'px' );
				}
			});
			$( "#insert_width" ).val( $( "#slider" ).slider( "value" ) + 'px' );
        });

		$( '#radio-group' ).livequery(function() {
			$(this).fadeIn('slow');
			$('#radio-group').buttonset();
		});

		$( '#files_right_pane' ).livequery(function() {
			$(this).children().fadeIn('slow');
			$('#upload-box').hide();
		});

		$( 'td.image button, a.button').livequery(function() {
			$(this).button();
		});

	});
})(jQuery);