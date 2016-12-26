var seatManager = {

	init: function( config ){

		this.config = config;
		var id = window.location.search.replace("?id=", "");
		console.log(id);
		if (isNaN(id) || !id){
			alert("Convocation id is not valid");
			window.location = "http://localhost:8888/GS/public/admin_convocation.php";
		} else {
			this.convocation_id = id;
		}

		this.load();
		this.bindEvents();
	},

	getURLParameter: function(name) {
	  return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)').exec(location.search)||[,""])[1].replace(/\+/g, '%20'))||null
	},

	lock: function(id){
		var id = "#" + id;
			id = $(id);
		id.css("background-color","#F1433F");
		id.removeClass("reservable");
		id.addClass("lock");
	},

	load:function(){


		$.ajax({                                      
		      url: 'process_load.php', 
		      type: 'POST',
		      data: {"id": seatManager.convocation_id}, 
		      async: false,        
		      dataType: 'json',                  
		      success: function(data)          
		      {	


		        	for (var i = 0; i < data.length; i++) {
		        		var rows = data[i].rows;
		        		var coloumns = data[i].coloumns;
		        		var label = data[i].label;
		        		var x = data[i].x;
		        		var y = data[i].y;
		        		var color = data[i].color;
		        		var reservable =  parseInt(data[i].reservable);
		        		var z_index = data[i].z_index;

		        		seatManager.createSeatGroup(rows,coloumns,label,color,x,y,reservable,z_index);
		        	};
		      } 
		});


		$.ajax({                                      
		      url: 'process_load_booking.php', 
		      type: 'POST',
		      data: {"id": seatManager.convocation_id},         
		      dataType: 'json',                    
		      success: function(data)          
		      {	
		      	for (var i = 0; i < data.length; i++) {
		        		seatManager.lock(data[i].first_seat_number);
		        		seatManager.lock(data[i].second_seat_number);


		        	}; 
		      } 
		});
	},



	bindEvents: function(){

		seatManager.config.canvas.on("click","span.seat",seatManager.book);
		$("#buttonSave").on("click",seatManager.save_booking);
		
	},


	book: function(){

		var el = $(this);
		var number = el.html();


		if( number%2 == 0 ){
				var next = el.prev();
		} else {
				var next = el.next();

		}



		var message = $("p.message");
		// console.log(el.hasClass("reservable"));

		if ( el.hasClass("lock") ){
			message.css("color","#F1433F");
			message.html("This seat is not available for booking.");
			return;
		}


		// if( el.is(":last-child")){
		// 	message.css("color","#F1433F");

		// 	message.html("You cannot book this seat, you need to book 2 seats next to eachother.");
		// 	return;
		// }

		// if ( el.hasClass("reservable") && next.hasClass("lock") ){
		// 	message.css("color","#F1433F");
		// 	message.html("You cannot book this seat, the next seat is not available for booking.");
		// 	return;
		// }
		

		if (el.has("reservable")){

			$("span.selected").removeClass("selected").addClass("reservable").css("background-color","#FDCD33");
			el.css("background-color","#2ECC71");
			el.removeClass("reservable");
			el.addClass("selected");
			next.css("background-color","#2ECC71");
			next.removeClass("reservable");
			next.addClass("selected");

			seatManager.firstSeat = el.attr("id");
			seatManager.secondSeat= next.attr("id");
			message.css("color","#64B743");
			message.html("Your desired seats are selected. Please press next to proceed with the booking for convocation.");
		} 
	},
 

	save_booking: function(){

		if ((seatManager.firstSeat && seatManager.secondSeat)){

				$.post(
				"process_save_booking.php",
				{"firstSeat":seatManager.firstSeat,"secondSeat":seatManager.secondSeat,"id":seatManager.convocation_id},
				function(data){

					var location = "apply_convocation.php";
					window.location =  location;
					
				}
			);
		} else {
			var message = $("p.message");
			message.css("color","#F1433F");
			message.html("You have not selected any seats. Please select your desired seats.");

		}

	},


	createSeatGroup: function(rows,coloumns,label,color,x,y,reservable,z_index){

		var row_letter = 65;
		var row_number = 0;

		var seatGroup      = "<div  class=\"seat-group\" style=\"z-index:" + z_index +";left:" + x + ";top:" + y + "\">";
		seatGroup += "<div class=\"label\" data-label=\"" + label + "\" style=\"background-color:" + color + "\">" + "<p class=\"label-content\">" + label + "</p>"  + "</div>";
		seatGroup += "<div class=\"seat-box\">";

		for (var i = 0; i < rows; i++) {
		seatGroup += "<div class=\"row\">";

			if (row_letter > 90) {
				row_letter = 65;
				row_number++;
			}
			seatGroup += "<span class=\"row-number\">" +  String.fromCharCode(row_letter++) + "" + row_number + "</span>" ;
			for (var j=0; j < coloumns ; j++) {

				seatGroup += "<span id=\"" + label + "-" + String.fromCharCode(row_letter-1) + "" + row_number  + "-" + (j+1) + "\" class=\"seat ";
				if (reservable){
					seatGroup += "reservable\">"
				} else {
					seatGroup += "lock\">"
				}
				seatGroup += j+1;
				seatGroup += "</span>";
			}

			seatGroup += "</div>";
		};

		seatGroup += "</div></div>";

		seatManager.config.canvas.append(seatGroup);   	
	},



	save_seatGroup: function(rows,coloumns,label,color,x,y,reservable,z_index){

		$.post("process_save.php",{

			"rows":rows,
			"coloumns":coloumns,
			"label":label,
			"x": x,
			"y": y,
			"color": color,
			"reservable": reservable,
			"convocation_id": seatManager.convocation_id,
			"z_index": z_index

		});

	},
}


seatManager.init({
		canvas: $("div.canvas"),
		seatGroup: $("div.seat-group"),
});