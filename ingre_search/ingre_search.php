<link rel="stylesheet" href="../style/ingre_search.css"/>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> 
 <script>

		var getingre = [];
		var getingre_array;
		var num_of_ingre = 0;
	var myFunction = function(id){
		var source = $('#feedback1 #'+id).attr('src');
		var alt = $('#feedback1 #'+id).attr('alt');
		if(num_of_ingre <10){
		if($('#feedback2 #a'+id).length == 0){
		$('#feedback2').append("<span class='explaw2' id='a"+id+"'><img onmouseover='showD(this.id)' onmouseout='unshowD(this.id)'  class='help' name='ingretofood[]' onclick='deleteit(this.id)' id='a"+id+"'  style='border: solid black 1px;' src='"+source+"' width='100' height='100'><span id='explaa"+id+"' style='display:none;'>"+alt+"</span></span><img  id='a"+id+"plus' src='../images/foodgroups/plus.png' width='20' height='20'>");    
		num_of_ingre++;
		getingre.push(id);
		getingre.sort(function(a, b) {  
			return a - b;
		}); 
		getingre_array = JSON.stringify(getingre);
		$('#str').val(getingre_array);
		}else{}}
	}
	var showD = function(id){
		$('#expla'+id).css({'display':'block'});
	}
	var unshowD = function(id){
		$('#expla'+id).css({'display':'none'});
	}

	var otherfunc = function(id){
		id = id.substr(2, 1); 
	$.post('../ingre_search/sukusai.php', { getid: id } , 
		function(result){
			$('#feedback1').html(result).show(); 
			$('#feedback1').append("<br><br><br><br>"); 
		});  
    }    
	 
	var deleteit = function(id){
		num_of_ingre--;
		$('#feedback2 #'+id).remove();
		$('#feedback2 #'+id+'plus').remove();
		var idonly = id.slice(1);
		var index = getingre.indexOf(idonly);
		console.log(index);
		getingre.splice(index,1);
		getingre.sort(function(a, b) { 
			return a - b;
		});  
		getingre_array = JSON.stringify(getingre);
		if(getingre.length > 0){
		$('#str').val(getingre_array);
		}else{
			$('#str').val(""); 
		}
		
	} 
	
	$(document).ready(function(){
    $('#sukusai').keyup(function(){
		var getword2 = $(this).val().toLowerCase(); 
		$.post('../ingre_search/sukusai.php', { getword: getword2 } , 
		function(result){
        $('#feedback1').html(result).show();
		$('#feedback1').append("<br><br><br><br>"); 
      });
    });


});
</script>
<style>

[id^="mm"]:hover{
	transform: scale(1.1); 
}
</style>
<form id='whatfood' action="../ingre_search/" method="get">
<div id="feedback2" style="height:200px;max-height: auto; padding: 10px 10px;">
	<input type="hidden" id="str" name="str" value="" />
	<span style="position: relative; float: left; width:90%;"><input type="checkbox" name="onlythese" value="onlythese">Only these ingredients</span>
	<form>
	<button   style="position: relative; top:5px; float: right; width:50px; height:100px;">Find Food!!</button>
	</form>
</div> 
	<div class="search2" style="width:100%; text-align: center;"> 
		<style>.search2 input{width:99%; height:45px; text-align: center; font-size: 30px;}</style>
		<input type="text" id='sukusai' name='sukusai' placeholder='Ingredient Search' autocomplete="off" />
	</div>   
	<div id="feedback3" style="height=100px;">
		<img src="../images/background/mitsui2.png" height="100">
		<style>#feedback3 img{margin: 10px 15px;}</style> 
		 
			<img onclick="otherfunc(this.id)" id='mm1' src='../images/foodgroups/vegi.png' width='100' height='100'>
			<img onclick="otherfunc(this.id)" id='mm2' src='../images/foodgroups/meat.png' width='100' height='100'>
			<img onclick="otherfunc(this.id)" id='mm3' src='../images/foodgroups/fish.png' width='100' height='100'>
			<img onclick="otherfunc(this.id)" id='mm4' src='../images/foodgroups/fruit.png' width='100' height='100'>
			<img onclick="otherfunc(this.id)" id='mm5' src='../images/foodgroups/grain.png' width='100' height='100'>
			<img onclick="otherfunc(this.id)" id='mm6' src='../images/foodgroups/etc.png' width='100' height='100'>
	</div> 
	<div id="feedback1" style="height:500px; overflow: scroll;">
	</div>
		<style>#feedback1 img{margin: 10px 10px;}</style>
</form>
