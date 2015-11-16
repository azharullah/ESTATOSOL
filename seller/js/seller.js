$(document).ready(function(){

	$("#optional1").empty();
	$("#optional2").empty();

	$(".type1").change(function(){
		var type = $(this).val()
		//console.log(type);
		if(type == "--")
		{
			$("#optional1").empty();		
		}
		if(type == "Flat")
		{
			$("#optional1").empty();
			$("#optional1").append('<label>No of Bedrooms</label> <input type="number" name="bhk1" placeholder="BHK" required> <br>');
			$("#optional1").append('<label>Parking available? : </label> <input type="radio" name="parking1" value="Yes"> Yes <input type="radio" name="parking1" value="No"> No <br>');
			$("#optional1").append('<label>Level/Floor number </label> <input type="number" name="floorno1" placeholder="Floor no" required> <br>');
		}
		if(type == "Villa")
		{
			$("#optional1").empty();
			$("#optional1").append('<label>Number of floors</label> <input type="number" name="nooffloors1" placeholder="No of floors" required> <br>');
		}
		if(type == "Independent House")
		{
			$("#optional1").empty();
			$("#optional1").append('<label>Parking available? : </label> <input type="radio" name="parking1" value="Yes"> Yes <input type="radio" name="parking1" value="No"> No <br>');
		}
		if(type == "Plot")
		{
			$("#optional1").empty();
			$("#optional1").append('<label>Plot number </label> <input type="number" name="plotno1" placeholder="Plot no" required> <br>');
		}
	})

	$(".type2").change(function(){
		var type = $(this).val()
		//console.log(type);
		if(type == "--")
		{
			$("#optional2").empty();		
		}
		if(type == "Flat")
		{
			$("#optional2").empty();
			$("#optional2").append('<label>No of Bedrooms</label> <input type="number" name="bhk2" placeholder="BHK" required> <br>');
			$("#optional2").append('<label>Parking available? : </label> <input type="radio" name="parking2" value="Yes"> Yes <input type="radio" name="parking2" value="No"> No <br>');
			$("#optional2").append('<label>Level/Floor number </label> <input type="number" name="floorno2" placeholder="Floor no" required> <br>');
		}
		if(type == "Villa")
		{
			$("#optional2").empty();
			$("#optional2").append('<label>Number of floors</label> <input type="number" name="nooffloors2" placeholder="No of floors" required> <br>');
		}
		if(type == "Independent House")
		{
			$("#optional2").empty();
			$("#optional2").append('<label>Parking available? : </label> <input type="radio" name="parking2" value="Yes"> Yes <input type="radio" name="parking2" value="No"> No <br>');
		}
		if(type == "Plot")
		{
			$("#optional2").empty();
			$("#optional2").append('<label>Plot number </label> <input type="number" name="plotno2" placeholder="Plot no" required> <br>');
		}
	})

	

})