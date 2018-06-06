<!DOCTYPE php>
<html>
<head>
	<style type="text/css">
		.hide_User,
		.hide_Pts,
		.hide_IP,
		.hide_Day,
		.hide_Day2,
		.hide_Hr,
		.hide_Active,
		.hide_HrLogout,
		.hide_Month{display:none}
	</style>
	<script type="text/javascript">
		var filters=['hide_User','hide_Pts','hide_IP','hide_Day','hide_Month','hide_Day2','hide_Hr','hide_Active','hide_HrLogout'];

		function ExcludeRows(cls){

		  var skipRows=[];

		  for(i=0;i<filters.length;i++)
		      if(filters[i]!=cls) skipRows.push(filters[i]);

		  var pattern=skipRows.join('|')

		  return pattern;
		}

		function Filter(srcField){

		   var node=srcField.parentNode;

		   var index=srcField.parentNode.cellIndex;
		    //all the DATA rows

		   var dataRows= document.getElementsByClassName("row");

		   //ensure that dataRows do not have any filter class added already
		   var kids= dataRows.length;

		   var filter ='hide_'+srcField.id;

		   var pattern = ExcludeRows(filter);

		   var skipRow = new RegExp(pattern,"gi");

		   var searchReg =new RegExp('^'+srcField.value,'gi');

		   var replaceCls= new RegExp(filter,'gi');

		   for(i=0; i< kids ; i++){
		       //skip if already filter applied  

		       if(dataRows[i].className.match(skipRow)) continue;

		       //now we know which column to search
		       //remove current filter
		       dataRows[i].className=dataRows[i].className.replace(replaceCls,'');

		       if(!dataRows[i].cells[index].innerHTML.trim().match(searchReg))
		          dataRows[i].className=dataRows[i].className +' '+ filter;

		    }



		}

		/*setTimeout(function(){
		   window.location.reload(1);
		}, 5000);*/

	</script>
	<title>Tablas de control</title>
</head>
	<body>
		
		<br>
		<br>
		<br>
		<br>
		<?php
			//$ret = exec("aureport --tty", $out, $err);

			//var_dump($ret);
			//var_dump($out);
			//var_dump($err);

		?>
		<table border="1" align="center">
			<tr><td>Name</td><td>Type</td><td>Data</td></tr>
			<tr>
			<td><input type="text" ID="User"    onkeydown="Filter(this)" /></td>
			<td><input type="text" ID="Pts"   onkeydown="Filter(this)" /></td>
			<td><input type="text" ID="IP"         onkeydown="Filter(this)" /></td>
			</tr>
			<?php
				
				$ret = exec("./myscript.sh 192.168.56.102", $out, $err);
				//var_dump($out);
				for ($x = 0; $x < sizeof($out); $x++) {

					$aux = str_replace('>','|',str_replace('<','|',addslashes($out[$x])));
					$myArray = explode(':',$aux);
				    
				    

				    if (sizeof($myArray)>3) {
				    	$temp.="<tr class='row'><td>";
				    	for ($i=0; $i < sizeof($myArray); $i++) { 
				    		
					    	if($i<2){
					    		$temp.=$myArray[$i];
					    		$temp.="</td><td>";
					    	}
					    	else{
					    		$temp.=$myArray[$i] .  ":";
					    	}
					    	
					    }
					    $temp.="</td></tr>";
					    echo $temp;

				    	
				    }else{
				    	echo "<tr class='row'><td>" . str_replace(':','</td><td>',$aux) . '</td></tr>';
				    }
				    
				} 
				//echo $out[1];
				//var_dump($err);

			?>
		</table>
	</body>
</html>