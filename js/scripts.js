// remap jQuery to $
(function($){




    })(this.jQuery);


// usage: log('inside coolFunc',this,arguments);
// paulirish.com/2009/log-a-lightweight-wrapper-for-consolelog/
window.log = function(){
    log.history = log.history || [];   // store logs to an array for reference
    log.history.push(arguments);
    if(this.console){
        console.log( Array.prototype.slice.call(arguments) );
    }
};

// inline input titles
$(function()  {
    $('input[title]').each(function() {
        if($(this).val() === '') {
            $(this).val($(this).attr('title'));
        }

        $(this).focus(function() {
            if($(this).val() === $(this).attr('title')) {
                $(this).val('').addClass('focused');
            }
        });

        $(this).blur(function() {
            if($(this).val() === '') {
                $(this).val($(this).attr('title')).removeClass('focused');
            }
        });
    });
});

// catch all document.write() calls
(function(doc){
    var write = doc.write;
    doc.write = function(q){
        log('document.write(): ',arguments);
        if (/docwriteregexwhitelist/.test(q)) write.apply(doc,arguments);
    };
})(document);

//button replace

$(function() {
    $("button, #linkbutton").button();


});

//pretty photo

$(function() {
    $("a[rel^='prettyPhoto']").prettyPhoto();
});

// top menu fader
$(function() {
    var fadedelay = 100;
    $('#top_menu li a').hover(function () {
        $(this).animate({

            color: "#cccccc"

        }, 100 );

    },
    function () {
        $(this).animate({

            color: "#ffffff"

        }, 100 );

    });

});
//big buttons fader
$(function() {
    var fadedelay = 100;
    $('.widebox a').hover(function () {
        $(this).closest('.widebox').animate({

            backgroundColor: "#bdc4c6"

        }, 100 );

    },
    function () {
        $(this).closest('.widebox').animate({

            backgroundColor: "#dce0e1"

        }, 100 );

    });

});

// editor
jQuery(function() {
    jQuery('.wymeditor').cleditor({
        });
});

//slideshow
$(function() {
    $('.cycle').cycle({
        fx: 'fade', // choose your transition type, ex: fade, scrollUp, shuffle, etc...
        speedIn:  500,
        speedOut: 500,
        timeout:  8000
    });
    $('.cycle').css("display", "block");
});

$(function() {
    $( "#guide_category" ).autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "/datasource/json_cats",
                data: {
                    term: $("#guide_category").val()
                },
                dataType: "json",
                type: "POST",
                success: function(data){
                    response(data);
                }
            });
        },
        minLength: 2
    });
});


$(function() {
 
    var quoteID = $('#top_controls').attr('class'),
    email = $("#email"),
    emessage = $("#emessage"),
    tips = $( ".validateTips" );
    
    function updateTips( t ) {
			tips
				.text( t )
				.addClass( "ui-state-highlight" );
			setTimeout(function() {
				tips.removeClass( "ui-state-highlight", 1500 );
			}, 500 );
		}
    
    function checkLength( o, n, min, max ) {
			if ( o.val().length > max || o.val().length < min ) {
				o.addClass( "ui-state-error" );
				updateTips( "Length of " + n + " must be between " +
					min + " and " + max + "." );
				return false;
			} else {
				return true;
			}
		}
   function checkRegexp( o, regexp, n ) {
			if ( !( regexp.test( o.val() ) ) ) {
				o.addClass( "ui-state-error" );
				updateTips( n );
				return false;
			} else {
				return true;
			}
		}
    
    
    
	
    $( "#dialog-form" ).dialog({
        autoOpen: false,
        modal: true,
        buttons: {
            Cancel: function() {
              //alert(email.val());
                $( this ).dialog( "close" );
            },
            Send: function() {
                var bValid = true;
                //check email is valid
                bValid = bValid && checkLength( email, "email", 6, 80 );
                bValid = bValid && checkRegexp( email, /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i, "eg. user@example.com" );
                
                
               if ( bValid ) {
                $.post('/quote/results/' + quoteID + '/email', {
                    email: email.val(),
                    emessage: emessage.val()
                }, function(data) {
alert(data);
                   $("#dialog-form").dialog('close');
                });
               }
             
                
            }
        }
    });




    $( "#email-pdf" ).click(function() {
        $( "#dialog-form" ).dialog( "open" );
    });
});

// execute your scripts when the DOM is ready. this is mostly a good habit
$(function() {

	// initialize scrollable
	$(".scrollable").scrollable();
        $(".scrollitem img[title]").tooltip();
        
        $(".scrollitem img").css({opacity: 0.9});
   

});

