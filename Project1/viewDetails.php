<?php

require('config.php');
	session_start();
	error_reporting(0);
	// if ($_SESSION["Type"]!='JDF'&&$_SESSION["Type"]!='ADF'&&$_SESSION["Type"]!='Member Secretary'&&$_SESSION["Type"]!='DFO'&&$_SESSION["Type"]!='FEO'&&$_SESSION["Type"]!='FFA')
	// {	
	// 	header("Location: ".ROOT_URL.'/Login.php');
	// }
	$details = $_SESSION["Username"]." - ".$_SESSION["Type"];
	$authType = $_SESSION['Type'];
	$disOptions = '';
	$diquery=" SELECT * FROM `districts`";
	$diresult = mysqli_query($conn,$diquery);
	$diposts = mysqli_fetch_all($diresult,MYSQLI_ASSOC);
	mysqli_free_result($diresult);
	foreach ($diposts as $dipost)
	{	
		$typeOp = $dipost["District"];
		$disOptions .= "<option value='$typeOp'>".$dipost["District"]."</option>";
	}

	require('Functions.php');

	$nodata = false;
	$ID = $_GET['ID'];
	$query = " SELECT * FROM `hatchery` WHERE `ID` = $ID ";
	$result = mysqli_query($conn,$query);
	$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);;
	if (count($posts)==0)
	{
		$nodata = true;
	}
	else
	{
		$post = $posts[0];
	}

	function dateFormat($date)
	{
		$ddmmyy = $date[8].$date[9].$date[7].$date[5].$date[6].$date[4].$date[2].$date[3];

		return $ddmmyy;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="css/forms.css">
</head>
<body>
<div class="Details">
	<form method="POST" action="details.php" enctype="multipart/form-data">
<?php if($post["Acc No"]!='ACR-0'){?>
	<div class="bg1">
		<h1>Accreditation Details</h1>
		<div class="formCont">
			<div class="cont" ><label>Accreditation No : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Acc No"]) ?>"  name="AccNo" required="required" >
		</div>
			<div class="formCont">
			<div class="cont" ><label>Valid Upto : </label><br></div>
			<input readonly type="text" value="<?php echo(dateFormat($post ["Acc Valid"])) ?>" name="valid" required="required" >
		</div>
	</div>
<?php  } ?>
	<div class="bg0">
		<h1>Owner's Details</h1>
		<div class="formCont">
			<div class="cont" ><label>Owner's Name : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's Name"]) ?>"  name="name" required="required" >
		</div>
			<div class="formCont">
			<div class="cont" ><label>Father's Name : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Father's Name"]) ?>" name="Fname" required="required" >
		</div>
	</div>
	<div class="bg1">
		<h1>Owner's Address</h1>
			<div class="formCont">
			<div class="cont" ><label>District</label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's District"]) ?>" name="Hname" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's Block"]) ?>" name="Oblock" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>GP/Ward : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's GP"]) ?>" name="Ogp" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Village/House-No., Street : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's Village"]) ?>" name="Ovillage" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Post Office : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's Post Office"]) ?>" name="Opo" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Police Station : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's Police Station"]) ?>" name="Opolice" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>PIN : </label><br></div>
			<input readonly type="text" value="<?php echo($post ["Owner's PIN"]) ?>" name="Opin" required="required" >
		</div>
		<div class="formCont">
			<input readonly class='invis' disabled="disabled">
		</div>
	</div>
	<div class="bg0">
	<h1>Contact Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Phone 1 : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Phone 1"]) ?>" name="Phn1" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Phone 2 : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Phone 2"]) ?>" name="Phn2" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Email : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Email"]) ?>" name="Email" required="required" >
	</div>
	<div class="formCont">
		<input readonly class='invis' disabled="disabled">
	</div>
	</div>
	<div class="bg1">
	<h1>Hatchery Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Hatchery Name : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery Name"]) ?>" name="Hname" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>District</label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery District"]) ?>" name="Hname" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery Block"]) ?>" name="Hblock" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>GP/Ward : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery GP"]) ?>" name="Hgp" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Village/House-No., Street : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery Village"]) ?>" name="Hvillage" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Post Office : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery Post Office"]) ?>" name="Hpo" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Police Station : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery Police Station"]) ?>" name="Hpolice" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>PIN : </label><br></div>
		<input readonly type="text" value="<?php echo($post ["Hatchery PIN"]) ?>" name="Hpin" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Species Cultured : </label><br></div>
		<input readonly type="text" class="long" value="<?php echo($post ["Species"]) ?>" name="species" required="required">
	</div>
	<div class="formCont">
		<input class='invis' disabled="disabled">
	</div>
	</div>
	<div class="bg0">
	<div class="photos">
		<h1>Photos</h1>
		<div class="formContP">
		<p><img id="output1" src="<?php echo ($post ["Owner's Photo"]) ?>"></p>
		<br>
		</div>
		<div class="formContP">
		<p><img id="output2" src="<?php echo $post['Hatchery Photo'] ?>"></p>
		<br>
	</div>
		<div class="formContP">
		<p><img id="output3" src="<?php echo ($post ['Aadhar Photo']) ?>"></p>
		<br>
	</div>

	<div class="formContP">
		<p><img id="output4" src="<?php echo ($post ['Challan Photo']) ?>"></p>
		<br>
		<div class="invis">
			<input type="date" value="" name="date" class="Ldate">
			<input type="text" value="" name="year"	class="year">
		</div>
		<div class="invis">
			<input type="text" class='invis empty1' name="Photoempty1" value="<?php echo ($post ["Owner's Photo"]) ?>" >
			<input type="text" class='invis empty2' name="Photoempty2" value="<?php echo ($post ['Hatchery Photo']) ?>" >
			<input type="text" class='invis empty3' name="Photoempty3" value="<?php echo ($post ['Aadhar Photo']) ?>" >
			<input type="text" class='invis empty4' name="Photoempty4" value="<?php echo ($post ['Challan Photo']) ?>" >
		</div>

	</div>
	</div>
	</div>
	<br><br>
	</form>
	<div class="links">
		<a href="#"><input type="submit" name="Submit" class="submit" value="Hatchery Infrastructure Details (Form-1A)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Water Parameter Details (Form-1B)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Assessment of Brooder Stock (Form-2)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Owner's Family & Water Body Details (Form-3)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Disease Information (Form-4)" ></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Species wise Production and Disposal Details (Form-5)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Species wise Seed Procurement Details (Form-6)"></a><br>
	</div>	
</body>
<script type="text/javascript">
	
	var loadFile1 = function(event)
	{
		var image = document.getElementById('output1');
		var oldimage = document.querySelector('.empty1');
		oldimage.value='';
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file1.value);
	};
	var loadFile2 = function(event)
	{
		var image = document.getElementById('output2');
		var oldimage = document.querySelector('.empty2');
		oldimage.value='';
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file2.value);
	};
	var loadFile3 = function(event)
	{
		var image = document.getElementById('output3');
		var oldimage = document.querySelector('.empty3');
		oldimage.value='';
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file3.value);
	};
	var loadFile4 = function(event)
	{
		var image = document.getElementById('output4');
		var oldimage = document.querySelector('.empty4');
		oldimage.value='';
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file4.value);
	};

	d = new Date();
	var minute , hour ;
	const date = document.querySelector(".Ldate");

	date.valueAsDate = new Date();
	const year = document.querySelector(".year");
	year.value = d.getYear()+1900;

	const imges = document.querySelectorAll('.photos img')
	console.log(imges);
	for (let index = 0; index < 4; index++) {

		imges[index].onclick = function(event){

			if (!(event.target.classList.contains('big'))){

				event.target.style.position='fixed';
				event.target.style.top='50px';
				event.target.style.left='50px';
				var big = document.querySelector('.big');
				console.log(big);
				if (big===null){

				}
				else{
					big.click();
				}
				event.target.classList.add('big');
			}
			else
			{
				event.target.style.position='revert';
				event.target.style.top='';
				event.target.style.left='';
				event.target.classList.remove('big');
			}
		}	
		
	}
	
</script>