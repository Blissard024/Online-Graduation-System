var seatManager = {

	init: function( config ){
		this.config = config;
		var id = window.location.search.replace("?id=", "");
		if (isNaN(id) || !id){
			alert("Convocation id is not valid");
			window.location = "http://localhost:8888/GS/public/admin_convocation.php";
		} else {
			this.convocation_id = id;
		}
		this.z_index = 0;
		this.load();
		this.bindEvents();
		this.saving = $("#saving");
		this.loading = $("#loading");
	},


	load:function(){

		$.ajax({                                      
		      url: 'process_load.php', 
		      type: 'POST',
		      data: {"id": seatManager.convocation_id}, 
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
					$("div.seat-group").draggable({handle: "div.label"}).on("click","a",seatManager.deleteSeatGroup);
					seatManager.updatePositions();




		      } 
		});
	},



	bindEvents: function(){
		this.config.formContainer.hide();
		// this.config.addSeatButton.hide();
		this.config.generatorForm.find("#generatorButton").on("click",this.generateSeatGroup);
		this.config.addSeatButton.on("click",function(e){

			$("p.error").html("");
			seatManager.config.formContainer.slideDown(500);

			seatManager.config.closeSeatFormButton.on("click",function(e){
				seatManager.config.formContainer.slideUp(500);
				e.preventDefault();
			});

			e.preventDefault();

		});
	},

	deleteSeatGroup: function(e){


		var element = $(this).closest("div.seat-group").remove();
		var label = element.find("div.label").attr("data-label");
		$.post("process_delete.php",{
			"label":label
		});
	},


	validateInput: function(){

		for (var i = 0; i < arguments.length; i++) {
			if (isNaN(arguments[i])){
				$("p.error").html("Rows and coloumns must be a number");
				return false;
			}
		};

		return true;
	},

	validateLabel: function(label){


		seat_groups = $("div.label");
		for (var i = 0; i < seat_groups.length; i++) {
			if ($(seat_groups[i]).attr("data-label") === label ){
				$("p.error").html("Label must be unique.");
				return false;
			}

		};

		return true;
	},


	validateColumn: function(column){


			if (column%2 != 0 ){
				$("p.error").html("Coloumns must be an even number.");
				return false;
			}

		return true;
	},



	validatePresence: function(){

		for (var i = 0; i < arguments.length; i++) {
			if (!arguments[i]){
				$("p.error").html("Fields Cannot be blank.");
				return false;
			}
		};

		return true;
	},


	createSeatGroup: function(rows,coloumns,label,color,x,y,reservable,z_index){

		var row_letter = 65;
		var row_number = 0;

		var seatGroup      = "<div  class=\"seat-group\" style=\"z-index:" + z_index +";left:" + x + ";top:" + y + "\">";

		seatGroup += "<div class=\"label\" data-label=\"" + label + "\" style=\"background-color:" + color + "\">" + "<p class=\"label-content\">" + label + "</p>" +  "<a class=\"close-seat-group\" href=\"#\">X</a>" + " </div>";
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

	updatePositions: function(){


		$("div.seat-group div.label").on("mouseup",function(){
	   		var label =  $(this).attr("data-label");
	   		var seatGroup = $(this).parent();
	   		var coords = seatGroup.position();
	   		


	   		$.post("process_update.php",{"label":label,"x":coords.left,"y":coords.top,"convocation_id": seatManager.convocation_id},function(z){
	   			seatGroup.css('z-index', z);
	   			// seatManager.saving.fadeIn();

	   		});
		});

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


	getZ: function(){


		var z_index;

		$.ajax({
		  type: 'POST',
		  url: "getZ.php",
		  data: {"convocation_id": seatManager.convocation_id},
		  async:false,
		  success: function(z){
			z_index = z;
			}
		});

		return z_index;
	},

	generateSeatGroup: function(e){

		var rows   = seatManager.config.generatorForm.find("#rows").val().trim();
		var coloumns = seatManager.config.generatorForm.find("#coloumns").val().trim();
		var label =    seatManager.config.generatorForm.find("#label").val().trim();
		var color = seatManager.config.generatorForm.find("#color").spectrum('get').toHexString();
		var reservable = seatManager.config.generatorForm.find("#reservable").is(':checked');
		var x = 300;
		var y = 10;
		var z_index =  seatManager.getZ() + 1;

		
		if ( seatManager.validatePresence(label,rows,coloumns) &&
		     seatManager.validateInput(rows,coloumns) && 
		     seatManager.validateLabel(label) &&
		      seatManager.validateColumn(coloumns)){
			seatManager.createSeatGroup(rows,coloumns,label,color,x,y,reservable,z_index);
			seatManager.save_seatGroup(rows,coloumns,label,color,x,y,reservable,z_index);
			$("div.seat-group").draggable({handle: "div.label"}).on("click","a",seatManager.deleteSeatGroup);
			seatManager.config.formContainer.slideUp(500);	
			seatManager.updatePositions();


		}
		
		e.preventDefault();
	}

};


seatManager.init({
		canvas: $("div.canvas"),
		generatorForm: $("form#generatorForm"),
		seatGroup: $("div.seat-group"),
		addSeatButton: $("input#add-seat"),
		formContainer: $("div.form-container"),
		closeSeatFormButton: $("input#cancel")
});