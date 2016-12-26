(function($){

	var title = $(document).attr('title');
	var links = $("ul.nav-menu").find("a");
	$.each(links,function(index,value){
		if ($(value).html() === title){
			$(value).addClass("active");

			if ($(value).closest("ul").attr("class") === undefined) {
				
				$(value).closest("ul").slideDown().prev().addClass("active");
				$(value).closest("ul").prev().addClass("active");
			}

		}

	});


	$("ul.nav-menu a").on("click",function(event){
			var speed = 400;
			var $this=$(this);
			var visbleNav = $("ul.nav-menu ul:visible");
			event.preventDefault();
			$this.addClass("active").parent().siblings().children("a").removeClass("active");


			var nextElement = $this.next();

			// clicking on open accordion
			if(nextElement.is("ul") && (nextElement.is(":visible"))){
				nextElement.slideUp(speed);
			} 

			// opening a accordion
			if (nextElement.is("ul") && (!nextElement.is(":visible"))){
				visbleNav.slideUp(speed);
				nextElement.slideDown(speed);
	 			// nextElement.find("a").first().addClass("active");
			}


			// clicking links
			if (!nextElement.is("ul") && $this.closest("ul").attr("class") === undefined )  {
				visbleNav.slideUp(speed,function(){
					window.location.href = $this.attr("href");
				});
			} else if (!nextElement.is("ul") && $this.closest("ul").attr("class") === "nav-menu" )  {
				if(visbleNav.length){
					visbleNav.slideUp(speed,function(){
						window.location.href = $this.attr("href");
					});
				} else {
					window.location.href = $this.attr("href");
				} 
			}
	});

})(jQuery);