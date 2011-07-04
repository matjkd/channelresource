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
		$("button").button();


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
                  data: { term: $("#guide_category").val()},
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