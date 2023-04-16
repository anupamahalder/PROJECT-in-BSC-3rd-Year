<?php
	require('config.php');
	session_start();
	error_reporting(1);
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
	$ID = $_SESSION['id'];
	$query = " SELECT * FROM `hatchery` WHERE `ID` = $ID ";
	$result = mysqli_query($conn,$query);
	$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
	if (count($posts)==0)
	{
		$nodata = true;
	}
	else
	{
		$post = $posts[0];

	}

	$renew = true;
	$date1=date_create($post['Acc Valid']);
	$date2=date_create(date("Y-m-d"));
	$diff=date_diff($date1,$date2);
	if ($diff->format("%R%a")<0)
	{
		$renew = false;
	}

	$check = true;
	$checkquery = " SELECT `Acc No` FROM `hatchery` WHERE `ID`='$ID'";
	$checkresult = mysqli_query($conn,$checkquery);
	$checkposts = mysqli_fetch_all($checkresult,MYSQLI_ASSOC);
	mysqli_free_result($checkresult);
	foreach ($checkposts as $checkpost)
	{
		if ($checkpost['Acc No']=='ACR-0')
		{
			$check=false;
			break;
		}

	}


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
		if (($_POST["Photoempty1"]!=''))
		{
			$Photo1 = $_POST["Photoempty1"];
		}
		else
		{
			$Photo1 = $_FILES["Photo1"]["name"];
		}
		if (($_POST["Photoempty2"]!=''))
		{
			$Photo2 = $_POST["Photoempty2"];
		}
		else
		{
			$Photo2 = $_FILES["Photo2"]["name"];
		}
		if (($_POST["Photoempty3"]!=''))
		{
			$Photo3 = $_POST["Photoempty3"];
		}
		else
		{
			$Photo3 = $_FILES["Photo3"]["name"];
		}
		if (($_POST["Photoempty4"]!=''))
		{
			$Photo4 = $_POST["Photoempty4"];
		}
		else
		{
			$Photo4 = $_FILES["Photo4"]["name"];
		}

		$dquery = "UPDATE `hatchery` SET `ID` = 'old$ID', `Current`='N' WHERE `ID` = '$ID'";
		mysqli_query($conn,$dquery);

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
			header("Location: ".ROOT_URL.'/accRenew.php');
			echo $query;
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
    session_start();
    include_once("config.php");
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
  <div class="err">
		<?php
		if ($check == false)
		{
			echo "	
				<div class='error'>Form not Accreditated, cannot apply for renewal</div>
			";
		}
		if ($nodata == true)
		{
			echo "	
				<div class='error'>No data exists apply for accreditation first</div>
			";
		}
		if ($renew == false && $check == true)
		{
			echo "
				<div class='error'>Renew after ".$diff->format("%a")." days</div>
			";
		}
	?>
	</div>
<div class="Details"
	 <?php
		if ($check == false)
		{
			echo "	style='opacity:0;position:absolute;z-index:-1;overflow:hidden;height:0px;'
			";
		}
		if ($nodata == true)
		{
			echo "	style='opacity:0;position:absolute;z-index:-1;overflow:hidden;height:0px;'
			";
		}
		if ($renew == false && $check == true)
		{
			echo "	style='opacity:0;position:absolute;z-index:-1;overflow:hidden;height:0px;'
			";
		}
	?> 
>
	<form method="POST" action="accRenew.php" enctype="multipart/form-data">
	<div class="bg0">
		<h1>Owner's Details</h1>
		<div class="formCont">
			<div class="cont" ><label>Owner's Name : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's Name"]) ?>"  name="name" required="required" >
		</div>
			<div class="formCont">
			<div class="cont" ><label>Father's Name : </label><br></div>
			<input type="text" value="<?php echo($post ["Father's Name"]) ?>" name="Fname" required="required" >
		</div>
	</div>
	<div class="bg1">
		<h1>Owner's Address</h1>
			<div class="formCont">
			<div class="cont" ><label>District</label><br></div>
			<select  name="Odistrict" class="oDistrict">
				<option value="Test"> Test </option>
				<?php
				echo $disOptions;
				?>
			</select>
		</div>
		<div class="formCont">
			<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's Block"]) ?>" name="Oblock" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>GP/Ward : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's GP"]) ?>" name="Ogp" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Village/House-No., Street : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's Village"]) ?>" name="Ovillage" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Post Office : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's Post Office"]) ?>" name="Opo" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>Police Station : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's Police Station"]) ?>" name="Opolice" required="required" >
		</div>
		<div class="formCont">
			<div class="cont" ><label>PIN : </label><br></div>
			<input type="text" value="<?php echo($post ["Owner's PIN"]) ?>" name="Opin" required="required" >
		</div>
		<div class="formCont">
			<input class='invis' disabled="disabled">
		</div>
	</div>
	<div class="bg0">
	<h1>Contact Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Phone 1 : </label><br></div>
		<input type="number" value="<?php echo($post ["Phone 1"]) ?>" name="Phn1" required="required" min="1000000000" max="9999999999">
	</div>
	<div class="formCont">
		<div class="cont" ><label>Phone 2 : </label><br></div>
		<input type="number" value="<?php echo($post ["Phone 2"]) ?>" name="Phn2" min="1000000000" max="9999999999">
	</div>
	<div class="formCont">
		<div class="cont" ><label>Email : </label><br></div>
		<input type="text" value="<?php echo($post ["Email"]) ?>" name="Email" required="required" >
	</div>
	<div class="formCont">
		<input class='invis' disabled="disabled">
	</div>
	</div>
	<div class="bg1">
	<h1>Hatchery Detials</h1>
	<div class="formCont">
		<div class="cont" ><label>Hatchery Name : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery Name"]) ?>" name="Hname" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>District</label><br></div>
		<select  name="Hdistrict" class="hDistrict">
			<option>Test</option>
			<?php
			echo $disOptions;
			?>
		</select>
	</div>
	<div class="formCont">
		<div class="cont" ><label>Block/Municipality/Corp : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery Block"]) ?>" name="Hblock" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>GP/Ward : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery GP"]) ?>" name="Hgp" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Village/House-No., Street : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery Village"]) ?>" name="Hvillage" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Post Office : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery Post Office"]) ?>" name="Hpo" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Police Station : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery Police Station"]) ?>" name="Hpolice" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>PIN : </label><br></div>
		<input type="text" value="<?php echo($post ["Hatchery PIN"]) ?>" name="Hpin" required="required" >
	</div>
	<div class="formCont">
		<div class="cont" ><label>Species Cultured : </label><br></div>
		<input type="text" class="long" value="<?php echo($post ["Species"]) ?>" name="species" required="required">
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
		<p><img id="output1" src="<?php echo ($post ["Owner's Photo"]) ?>"></p>
		<br>
		</div>


		<div class="formContP">
		<input type="file"  accept="image/*" name="Photo2" id="file2"  onchange="loadFile2(event)" style="display: none;">

		<label class="upload" for="file2" ><i></i>Click to Upload Hatchery Photo</label></input>
		<p><img id="output2" src="<?php echo $post['Hatchery Photo'] ?>"></p>
		<br>
	</div>
		<div class="formContP">
		<input type="file"  accept="image/*" name="Photo3" id="file3"  onchange="loadFile3(event)" style="display: none;">

		<label class="upload" for="file3" ><i></i>Click to Upload Aadhar Photo</label></input>
		<p><img id="output3" src="<?php echo ($post ['Aadhar Photo']) ?>"></p>
		<br>
	</div>

	<div class="formContP">
		<input type="file"  accept="image/*" name="Photo4" id="file4"  onchange="loadFile4(event)" style="display: none;">

		<label class="upload" for="file4" ><i></i>Click to Upload Challan Photo</label></input>
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
	<input type="submit" name="Submit" class="submit" value="Submit"
	<?php
		if ($check==false)
		{
			echo "disabled='disabled'";
		}
		if ($nodata==true)
		{
			echo "disabled='disabled'";
		}
		if ($renew==false)
		{
			echo "disabled='disabled'";
		}
	?>
	>

	</form>
	<div class="links">
		<a href="#"><input type="submit" name="Submit" class="submit" value="Hatchery Infrastructure Details (Form-1A)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Water Parameter Details (Form-1B)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Assessment of Brooder Stock (Form-2)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Owner’s Family & Water Body Details (Form-3)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Disease Information (Form-4)" ></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Species wise Production and Disposal Details (Form-5)"></a><br>
		<a href="#"><input type="submit" name="Submit" class="submit" value="Species wise Seed Procurement Details (Form-6)"></a><br>
	</div>	
</body>
</body>
</html>
  </section>

  <script src="javascript/script4.js"></script>
<!-- <style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap');
html
{
	/*background-image: linear-gradient(to bottom right, #43cea259 , #185a9d78 );*/
	background-image: url('bluebg.png');
	background-size: cover;
}
body
{	
	margin: 0;
	min-height: 100vh;
}
nav
{	
	text-align: center;
    display: inline-flex;
    flex-wrap: wrap;
    margin: 10px;
    padding: 10px;
    width: 100%;
    box-sizing: border-box;
    background-image: url(bluebg.png);
    background-position: bottom;
    line-height: 1.6em;
    margin: 0;
    /* backdrop-filter: blur(5px); */
    box-shadow: rgb(163 247 255 / 53%) 1px 6px 20px 5px;
    justify-content: space-between;
    min-width: 800px;
    font-family: 'Open Sans', sans-serif;
}
nav p
{	
	margin: 0;
	text-align: left;
	line-height: 1.2em;
	color: black;
	font-size: 1.6em;
}
.date
{
	top: 0px;
	right: 20px;
}
.home
{
	display: inline-flex;
	flex-wrap: nowrap;
	width: 50%;
}
.home p
{
	margin-left: 20px;
}
a
{
	text-decoration: none;
	color: black;
	display: inherit;
}
nav a:hover
{
	font-weight: bolder;
}
.details
{
	margin: auto;
	margin-top: 20px;
}
.details input
{
	font-size: 1.7em;
	padding: 0px;
}
.details p
{
	font-size: 1.7em;
	width:700px;
	text-align: center;
	font-family: 'Open Sans', sans-serif;
	font-weight: lighter;
}
.long
{
	width: 1125px;
    margin-left: 145px;
}
a
{
	text-decoration: none;
	color:black;
}
.err
{	
	height:150px;
	text-align: center;
	background:white;
	margin: 30px;
	margin-top: 20px;
	padding-bottom: 0px;
	box-shadow: -9px 13px 13px 1px #4d4d4d;
	vertical-align: middle;
}
.error
{	
	text-align: center;
	color: red;
	font-size: 2em;
	font-weight: bold;
	height: 60px;
	font-size: 38px;
}
.logo
{	
	text-align: left;
	color: black;
	font-size: 2.6em;
	display: inline-block;
}

.container
{	
	font-size: 1.7em;
	display: inline-block;
}

.logo a:hover
{	
	color: black;
	background: transparent;
}
.details input,select
{
	padding:15px;
	width:250px ;
	font-size: 25px;
	background: #ececec ;
	border: 0px solid black; 
	outline: none;
	border-radius: 5px;
	transition-delay: 0.15s;
	background: transparent;
	color: black;
}
.logo
{	
	text-align: left;
	color: black;
	font-size: 5em;
	display: inline-block;
	margin-bottom: 30px;
}
.Details
{	
	text-align: center;
	background:white;
	margin: 30px;
	margin-top: 20px;
	color: black;
	padding: 20px;
	padding-bottom: 0px;
	box-shadow: -9px 13px 13px 1px #4d4d4d;
}
.Details h1
{
	margin-top: 80px;
	margin-bottom: 5px;
}
label
{
	font-size: 30px;
	line-height: 60px;
	width: 200px;
}
input.submit
{

	background-image: linear-gradient(to bottom right, purple, #0066ff);
	width: 300px;
	height: 60px;
	border: 2px solid black;
	font-size: 22px;
	border-radius: 10px;
	margin: 30px;
	color: white;
	transition-delay: 0s;
}

input,select
{
	padding:10px;
	width:400px ;
	font-size: 30px;
	background: #a8ffff;
	outline: none;
	border: 0px solid black;
	border-radius: 5px;
	transition-delay: 0.15s;
}
select
{
	width: 420px;
}
.Details input,select
{
	border:1px solid black;
}
.Details input:hover,select:hover
{
	background: #68fcfc;
}
.Details input:focus,select:focus
{
	background: transparent;
	border: 2px solid black;
}
input.submit:focus
{
	background-image: linear-gradient(to bottom right, purple, #0066ff);
}
input.submit:hover
{
	background: #0066ff;
	cursor: pointer;
}
.formCont
{
	display: inline-block;
	width: 45%;
	margin-bottom: 50px;
}
.cont
{	
	margin: auto;
	text-align: left;
	width: 420px;
}
.user
{	
	min-width: 300px;
	display: block;
	margin-top: 20px;
}
.invis
{
	position: absolute;
	left: -1700px;	
}
.photos
{
	display: inline-block;
	text-align: center;
	width: 100%;
}
.photos label
{
	font-size: 20px;
	cursor: pointer;
}
.formContP
{
	display: inline-block;
	width: 20%;
	margin:auto;

}
#output1,#output2,#output3,#output4
{
	width: 200px;
	height: 250px;
	border: 2px solid black;
	margin:auto;
	transition-duration: 0s;
}
#output2,#output3
{
	width: 250px;
	height: 200px;
}
.links
{
	display: block;
	width: 100%;
}
.links input.submit
{	
	width: 60%;
	min-width: 650px;
	margin: 0px;
	padding: 2px;
}
.links input.submit:hover
{
	background: darkorange;
}
.bg0
{	
	display: inline-block;
	width: 100%;
	background: #dbf0ff;
}
.bg1
{	
	display: inline-block;
	width: 100%;
	background: #dbffe2;

}
.big
{
	height: 600px !important;
	width: auto !important;
	transition-duration: 0.5s !important;
}
@media screen and (max-width: 900px)
{
	.details label
	{
		font-size: 25px;
	}
	.details input
	{
		font-size: 20px;
		width: 190px;
	}
}
@media screen and (max-width: 1200px) {
  .formCont
	{	
		display: block;
		width: 100%;
	}
	input
	{
		width: 600px;
		font-size: 35px;
	}
	.long
	{
		width: 600px;
		margin-left: 0px;
	}
	select
	{
		width: 620px;
		font-size: 35px;
	}
	label
	{
		font-size: 35px;
	}
	.cont
	{
		width: 620px;
	}
	.formContP
	{
		display: block;
		width: 100%
	}
	#output1,#output2,#output3,#output4
	{
		width: 300px;
		height: 425px;
	}
	#output2,#output3
	{
		width: 425px;
		height: 300px;
	}
}
</style> -->
<script type="text/javascript">

	var img = document.querySelector("img");
	img.onload = function()
	{
		var height = img.height;
		var width = img.width;
		console.log(height,width);
	}

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

	const oDistrict = document.querySelector('.oDistrict');
	for (var i = oDistrict.childNodes.length - 2; i >= 1; i--)
	{	

		if(oDistrict.childNodes[i].value == "<?php echo $post ["Owner's District"] ?>")
		{
			oDistrict.childNodes[i].setAttribute("selected","selected");

		}
	}
	const hDistrict = document.querySelector('.hDistrict');
	for (var i = hDistrict.childNodes.length - 2; i >= 1; i--)
	{	

		if(hDistrict.childNodes[i].value == "<?php echo $post ["Hatchery District"] ?>")
		{
			hDistrict.childNodes[i].setAttribute("selected","selected");

		}
	}

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