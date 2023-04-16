<?php
	require('config.php');
	session_start();
	$check = true;
	$checkquery = " SELECT `ID` FROM `hatchery`";
	$checkresult = mysqli_query($conn,$checkquery);
	$checkposts = mysqli_fetch_all($checkresult,MYSQLI_ASSOC);
	mysqli_free_result($checkresult);
	foreach ($checkposts as $checkpost)
	{
		if ($checkpost['ID']==$_SESSION['id'])
		{
			$check=false;
			break;
		}

	}

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

	if(filter_has_var(INPUT_POST, 'Submit'))
	{	
		$ID = $_SESSION['id'];
		$name = $_POST['name'] ;
		$Fname = $_POST['Fname'];
		$Odistrict = $_POST['Odistrict'];
		$Oblock = $_POST['Oblock'];
		$Ogp = $_POST['Ogp'];
		$Ovillage = $_POST['Ovillage'];
		$Opo = $_POST['Opo'];
		$Opolice = $_POST['Opolice'];
		$Opin = $_POST['Opin'];
		$Phn1 = $_POST['Phn1'];
		$Phn2 = $_POST['Phn2'];
		$Email = $_POST['Email'];
		$Hname = $_POST['Hname'];
		$Hdistrict = $_POST['Hdistrict'];
		$Hblock = $_POST['Hblock'];
		$Hgp = $_POST['Hgp'];
		$Hvillage = $_POST['Hvillage'];
		$Hpo = $_POST['Hpo'];
		$Hpolice = $_POST['Hpolice'];
		$Hpin = $_POST['Hpin'];
		$species = $_POST['species'];
		$Photo1 = $_FILES['Photo1']["name"];
		$Photo2 = $_FILES['Photo2']["name"];
		$Photo3 = $_FILES['Photo3']["name"];
		$Photo4 = $_FILES['Photo4']["name"];

		$oquery = " SELECT * FROM `hatchery` WHERE `ID` = 'old$ID' ORDER BY `ID Year` DESC";
		$oresult = mysqli_query($conn,$oquery);
		$oposts = mysqli_fetch_all($oresult,MYSQLI_ASSOC);
		if (!empty($oposts[0])) 
		{	
			$date = date('Y-m-d',strtotime($oposts[0]['Acc Valid']. '+ 1 days'));
			$valdate = date('Y-m-d',strtotime($oposts[0]['Acc Valid']. '+ 1 Years'));
			$year = $date[0].$date[1].$date[2].$date[3];
		}
		else
		{
			$date = $_POST['date'];
			$year = $_POST['year'];
			$valdate = date('Y-m-d',strtotime($date. '+ 1 Years'));
		}
		$appdate = $_POST['date'];
		$idyear = $ID.'y'.$year;
	
		$query = " INSERT INTO `hatchery` (`ID`, `ID Year`, `Owner's Name`, `Father's Name`, `Owner's District`, `Owner's Block`, `Owner's GP`, `Owner's Village`, `Owner's Post Office`, `Owner's Police Station`, `Owner's PIN`, `Phone 1`, `Phone 2`, `Email`, `Hatchery Name`, `Hatchery District`, `Hatchery Block`, `Hatchery GP`, `Hatchery Village`, `Hatchery Post Office`, `Hatchery Police Station`, `Hatchery PIN`, `Species`, `Owner's Photo`, `Hatchery Photo`, `Aadhar Photo`, `Challan Photo`, `App Date`, `Year`, `Acc No`, `Acc Date`, `Acc Valid`, `Current`) VALUES ('$ID', '$idyear', '$name', '$Fname', '$Odistrict', '$Oblock', '$Ogp', '$Ovillage', '$Opo', '$Opolice', '$Opin', '$Phn1', '$Phn2', '$Email', '$Hname' , '$Hdistrict', '$Hblock', '$Hgp', '$Hvillage', '$Hpo', '$Hpolice', '$Hpin', '$species', '$Photo1', '$Photo2', '$Photo3', '$Photo4', '$appdate', '$year', 'ACR-0', '', '$valdate', 'Y') ";

		


		if( mysqli_query($conn,$query))
		{	
			upload('Photo1');
			upload('Photo2');
			upload('Photo3');
			upload('Photo4');
			header("Location:/http://localhost/hatchery_project/Project1/user_service_dashboard.php.php");
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
	<link rel="stylesheet" href="css/forms.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<?php
    $logid=$_SESSION["id"];
    $sql = "SELECT * from reg_tb WHERE id='".$logid."'";
    $result = mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $name=$row['name'];
        $type=$row['type'];
    }
    ?>
  <div class="sidebar">
    <div class="logo-details">
    <img src="images/logo.jpg" style="height: 40px;width: 50px; padding-right: 10px;" class="photo">
        <div class="logo_name">Department Of Fisheries</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <li>
	  <a href="accApply.php">
	  <i class='bx bx-file-blank' ></i>
          <span class="links_name">Fresh Accreditation</span>
        </a>
         <span class="tooltip">Application for Fresh Accreditation</span>
      </li>
      <li>
	  <a href="accRenew.php">
	   <i class='bx bx-reset' ></i>
         <span class="links_name">Application Renewal</span>
       </a>
       <span class="tooltip">Application for Renewal</span>
     </li>
     <li>
       <a href="details.php">
	   <i class='bx bx-info-square'></i>
         <span class="links_name">Application Information </span>
       </a>
       <span class="tooltip">Application Information </span>
     </li>
     <li>
       <a href="appStatus.php">
	   <i class='bx bx-check-square' ></i>
         <span class="links_name">Application Status</span>
       </a>
       <span class="tooltip">Application Status</span>
     </li>
     <li>
       <a href="accView.php" target="_blank">
	   <i class='bx bx-certification' ></i>
         <span class="links_name">Accreditation Certificate</span>
       </a>
       <span class="tooltip">Accreditation Certificate</span>
     </li>
     <li>
       <a href="feedback.php">
	   <i class='bx bx-chat' ></i>
         <span class="links_name">FeedBack</span>
       </a>
       <span class="tooltip">FeedBack</span>
     </li>
     <!-- <li>
       <a href="#">
         <i class='bx bx-heart' ></i>
         <span class="links_name">Saved</span>
       </a>
       <span class="tooltip">Saved</span>
     </li>-->
     <li>
       <a href="./user_service_dashboard.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name"><?php echo $name;?></div>
             <div class="job"><?php echo $type;?></div>
           </div>
           <a href="sesdestroy.php"><i class='bx bx-log-out' id="log_out" ></i></a>
         </div> 
     </li>
    </ul>
  </div>
  <section class="home-section">
    	
		<?php
		if ($check == false)
		{
			echo "	<div class='err'>
				<div class='error'>Form already applied, cannot Submit anymore</div>
					</div>
			";
		}
		?>		
	
<div class="Details" <?php
		if ($check == false)
		{
			echo "	style='opacity:0;position:absolute;z-index:-1;overflow:hidden;height:0px;'
			";
		}
	?>>
	<form method="POST" action="accApply.php" enctype="multipart/form-data">
	<div class="bg0">
		<h1>Owner's Details</h1>
		<div class="formCont">
			<div class="cont" ><label>Owner's Name : </label><br></div>
			<input type="text" value="" name="name" required="required" >
		</div>
			<div class="formCont">
			<div class="cont" ><label>Father's Name : </label><br></div>
			<input type="text" value="" name="Fname" required="required" >
		</div>
	</div>
	<div class="bg1">
		<h1>Owner's Address</h1>
			<div class="formCont">
			<div class="cont" ><label>District</label><br></div>
			<select  name="Odistrict" class="type">
				<?php
				echo $disOptions;
				?>
			</select>
		</div>
		<div class="formCont">
			<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
			<input type="text" value="" name="Oblock" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>GP/Ward : </label><br></div>
			<input type="text" value="" name="Ogp" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Village/House-No., Street : </label><br></div>
			<input type="text" value="" name="Ovillage" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Post Office : </label><br></div>
			<input type="text" value="" name="Opo" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Police Station : </label><br></div>
			<input type="text" value="" name="Opolice" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>PIN : </label><br></div>
			<input type="text" value="" name="Opin" required="required" >
		</div>
		<div class="formCont">
			<input class='invis' disabled="disabled">
		</div>
	</div>
	<div class="bg0">
	<h1>Contact Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Phone 1 : </label><br></div>
		<input type="number" value="" name="Phn1" required="required" min="1000000000" max="9999999999">
	</div>
	<div class="formCont">
		<div class="cont" ><label>Phone 2 : </label><br></div>
		<input type="number" value="" name="Phn2"  min="1000000000" max="9999999999">
	</div>
	<div class="formCont">
		<div class="cont" ><label>Email : </label><br></div>
		<input type="text" value="" name="Email" required="required" >
	</div>
	<div class="formCont">
		<input class='invis' disabled="disabled">
	</div>
	</div>
	<div class="bg1">
	<h1>Hatchery Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Hatchery Name : </label><br></div>
		<input type="text" value="" name="Hname" required="required" class="hname">
	</div>
	<div class="formCont">
		<div class="cont" ><label>District</label><br></div>
		<select  name="Hdistrict" class="type">
			<?php
			echo $disOptions;
			?>
		</select>
	</div>
	<div class="formCont">
		<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
		<input type="text" value="" name="Hblock" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>GP/Ward : </label><br></div>
		<input type="text" value="" name="Hgp" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Village/House-No., Street : </label><br></div>
		<input type="text" value="" name="Hvillage" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Post Office : </label><br></div>
		<input type="text" value="" name="Hpo" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Police Station : </label><br></div>
		<input type="text" value="" name="Hpolice" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>PIN : </label><br></div>
		<input type="text" value="" name="Hpin" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Species Cultured : </label><br></div>
		<input type="text" class="long" value="" name="species" required="required" >
	</div>
	<div class="formCont">
		<input class='invis' disabled="disabled">
	</div>
	</div>
	<div class="bg0">
	<div class="photos">
		<h1>Upload Photos</h1>
		<div class="formContP">
		<input type="file"  accept="image/*" name="Photo1" id="file1"  onchange="loadFile1(event)" style="display: none;">
		<label class="upload" for="file1" ><i></i>Click to Upload Owner's Photo</label></input>
		<p><img id="output1" ></p>
		<br>
		</div>


		<div class="formContP">
		<input type="file"  accept="image/*" name="Photo2" id="file2"  onchange="loadFile2(event)" style="display: none;">

		<label class="upload" for="file2" ><i></i>Click to Upload Hatchery Photo</label></input>
		<p><img id="output2" ></p>
		<br>
	</div>
		<div class="formContP">
		<input type="file"  accept="image/*" name="Photo3" id="file3"  onchange="loadFile3(event)" style="display: none;">

		<label class="upload" for="file3" ><i></i>Click to Upload Aadhar Photo</label></input>
		<p><img id="output3" ></p>
		<br>
	</div>

	<div class="formContP">
		<input type="file"  accept="image/*" name="Photo4" id="file4"  onchange="loadFile4(event)" style="display: none;">

		<label class="upload" for="file4" ><i></i>Click to Upload Challan Photo</label></input>
		<p><img id="output4" ></p>
		<br>
		<div class="invis">
			<input type="date" value="" name="date" class="Ldate">
			<input type="text" value="" name="year"	class="year">
	</div>
	</div>
	</div>
	</div>
	<br><br>
	<input type="submit" name="Submit" class="submit" value="Submit"
	<?php
		if ($check==false)
		{
			echo "disabled='disabled'";
		}
	?>
	>

	</form>
	<div class="links">
		<a href="form1a.php"><input type="submit" name="Submit" class="submit" value="Hatchery Infrastructure Details (Form-1A)"></a><br>
		<a href="form1b.php"><input type="submit" name="Submit" class="submit" value="Water Parameter Details (Form-1B)"></a><br>
		<a href="form2.php"><input type="submit" name="Submit" class="submit" value="Assessment of Brooder Stock (Form-2)"></a><br>
		<a href="form3.php"><input type="submit" name="Submit" class="submit" value="Owner’s Family & Water Body Details (Form-3)"></a><br>
		<a href="form4.php"><input type="submit" name="Submit" class="submit" value="Disease Information (Form-4)" ></a><br>
		<a href="form5.php"><input type="submit" name="Submit" class="submit" value="Species wise Production and Disposal Details (Form-5)"></a><br>
		<a href="form6.php"><input type="submit" name="Submit" class="submit" value="Species wise Seed Procurement Details (Form-6)"></a><br>
	</div>
  </section>

  <script src="javascript/script4.js"></script>
</body>
</html>
<script type="text/javascript">
	var loadFile1 = function(event)

	{
		var image = document.getElementById('output1');
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file1.value);
	};
	var loadFile2 = function(event)

	{
		var image = document.getElementById('output2');
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file2.value);
	};
	var loadFile3 = function(event)

	{
		var image = document.getElementById('output3');
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file3.value);
	};
	var loadFile4 = function(event)

	{
		var image = document.getElementById('output4');
		console.log(image.src = URL.createObjectURL(event.target.files[0]));
		console.log(file4.value);
	};



	d = new Date();
	var minute , hour ;
	const date = document.querySelector(".Ldate");

	date.valueAsDate = new Date();
	const year = document.querySelector(".year");
	year.value = d.getYear()+1900;



	var source = new Array();
	var target = new Array();
	var districts = new Array();

	<?php foreach ($diposts as $dipost): ?>
		districts.push("<?php echo ($dipost['District']) ?>");
	<?php endforeach ?>


	for (var i = 1 ; i <= 7; i++)
	{
		source[source.length] = document.querySelectorAll('.bg1')[0].children[i].children[1];
	}

	for (var i = 2 ; i <= 8; i++)
	{
		target[target.length] = document.querySelectorAll('.bg1')[1].children[i].children[1];
	}


	for (var i = 1 ; i<=6 ; i++)
	{	

		source[i].onchange = function(event)
		{
			target[source.indexOf(event.target)].value = source[source.indexOf(event.target)].value;
		}
	}
	source[0].onchange =function()
	{
		target[0].selectedIndex = districts.indexOf(source[0].value);
	}

	//Image
	// const imges = document.querySelectorAll('.photos img')
	// console.log(imges);
	// for (let index = 0; index < 4; index++) {

	// 	imges[index].onclick = function(event){

	// 		if (!(event.target.classList.contains('big'))){

	// 			event.target.style.position='fixed';
	// 			event.target.style.top='50px';
	// 			event.target.style.left='50px';
	// 			var big = document.querySelector('.big');
	// 			console.log(big);
	// 			if (big===null){

	// 			}
	// 			else{
	// 				big.click();
	// 			}
	// 			event.target.classList.add('big');
	// 		}
	// 		else
	// 		{
	// 			event.target.style.position='revert';
	// 			event.target.style.top='';
	// 			event.target.style.left='';
	// 			event.target.classList.remove('big');
	// 		}
	// 	}	
		
	// }

	const input = document.querySelectorAll('input');
	for (var i = input.length - 1; i >= 0; i--)
	{
		input[i].onkeydown = function myFunction()
		{	

		    var e = event || window.event;  // get event object
		    var key = e.keyCode || e.which; // get key cross-browser

		    if (key == 222)
		    { 
		        if (e.preventDefault) e.preventDefault(); 
		        e.returnValue = false;
			}
		}
	}
</script>