
		$(document).ready(function(){
			$('.stay-top-right .acc').click(function(){
                            
                             var minHeight = $("#jumping").css('min-height');
                                $("#jumping").css('min-height',0).slideToggle("slow", function() {
                                    $(this).css('min-height', minHeight);
                                });
			});
		});
			
