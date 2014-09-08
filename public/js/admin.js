/*
Version: 1.0
Author: Acit Jazz 2014
*/
$(document).ready(function() { 
	// popup
	$('.showPopup').magnificPopup({
	  type:'inline',
	  midClick: true 
	});
	
	$('.notibar .close').click(function(){
		$(this).parent().fadeOut(function(){
			$(this).remove();
		});
	});

	if($.cookie("state") == 1) {
		$('#body').addClass("smallmenu");
	} else if ($.cookie("state") == 0){
		$('#body').removeClass("smallmenu");
	}
	$( ".collapse" ).click(function() {
	   $( "#body" ).toggleClass( "smallmenu" );
		if($("#body").hasClass("smallmenu")) {
			$.cookie("state", 1);
		} else {
			$.cookie("state", 0);
		}
		return false;
	});
	$('#navigation').superfish();
	$('.datepicker').datepicker();

	 // Tab
	  $(function() {
		$( "#tabs" ).tabs();
	  });
});
function dragposition() {
  $(function() {
	$( "#sortable" ).sortable({
	   revert: true
	});
	$( "ul, li" ).disableSelection();
  });
}