<?php
	require('config.php');
	session_start();
	// error_reporting(0);
	// if ($_SESSION["Type"]!='JDF'&&$_SESSION["Type"]!='ADF'&&$_SESSION["Type"]!='Member Secretary'&&$_SESSION["Type"]!='DFO'&&$_SESSION["Type"]!='FEO'&&$_SESSION["Type"]!='FFA')
	// {	
	// 	header("Location: ".ROOT_URL.'/Login.php');
	// }
	$logid=$_SESSION["id"];
    $sql = "SELECT * from reg_tb WHERE id='".$logid."'";
    $result = mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $name=$row['name'];
        $type=$row['type'];
		$currDistrict=$row['district'];
    }
	$authBy = $name;
	$authType = $type;
	$max = false;
	$min = false;
	$nodata = false;

	$form = '';
	$authDistrict = $currDistrict;

	if($authType!='Level-3 Officer'){
		$dquery=" SELECT * FROM `hatchery` WHERE `Acc No`!='ACR-0' AND `Current`='Y' AND `Hatchery District` = '$authDistrict' ORDER BY `Acc Valid`";
	}else{
		$dquery=" SELECT * FROM `hatchery` WHERE `Acc No`!='ACR-0' AND `Current`='Y' ORDER BY `Acc Valid`";
	}

	require('Functions.php');

	function dateFormat($date)
	{
		$ddmmyy = $date[8].$date[9].$date[7].$date[5].$date[6].$date[4].$date[2].$date[3];

		return $ddmmyy;
	}

	$dresult = mysqli_query($conn,$dquery);
	$dposts = mysqli_fetch_all($dresult,MYSQLI_ASSOC);
	mysqli_free_result($dresult);
	foreach ($dposts as $dpost)
	{	
		$due = '#ffcbc7';//red;
		$date1=date_create($dpost['Acc Valid']);
		$date2=date_create(date("Y-m-d"));
		$diff=date_diff($date1,$date2);
		if ($diff->format("%R%a")<=0)
		{
			$due = '#c9ffba';//green;
		}
		$form .= "
		<form method='POST' action='Auth.php'>
		<div class='EachAuth' style='background:".$due."'>
	<form method='POST' action='Auth.php' >
	<div class='formCont'>
		<div class='cont'  >
		<label class='districtL'>District : </label>
		<br></div>
		<input  name='District' value='".$dpost['Hatchery District']."' disabled>
		</input>
	</div>
	<div class='formCont'>
		<div class='cont' ><label>Accreditation No : </label><br></div>
		<input type='text'  name='ID' readonly value=" .$dpost['Acc No']. " >
	</div>
	<div class='formCont'>
		<div class='cont' ><label>Owner Name : </label><br></div>
		<input type='text'  name='name'  disabled  value='".($dpost["Owner's Name"])."'>
	</div>
		<div class='formCont'>
		<div class='cont' ><label>Hatchery Name : </label><br></div>
		<input type='text' value='".$dpost['Hatchery Name']."' name='mobileNo'  disabled >
	</div>
	<div class='formCont'>
		<div class='cont' ><label>Valid upto : </label><br></div>
		<input  name='userType' class='type' value='".dateFormat($dpost['Acc Valid'])."' disabled>
		</input>
	</div>
	<div class='formCont'>
		<div class='cont' >
		<label class='districtL'>Due Days : </label>
		<br></div>
		<input  name='District' value='".$diff->format("%y years %m months and %d days")."   (".$diff->format("%R").") ' disabled>
		</input>
	</div>
	<div class='formCont'>
		<a href='./viewDetails.php?ID=".$dpost["ID"]. "' target='_blank'><input readonly type='text' class='submit' name='View' value='View' style='width:-webkit-fill-available'></a>
	</div>
	</div>
	<br><br>
	</form>
	</div>	";
	}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<?php
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
	<?php if($authType == "Level-2 Officer"){?>
       <a href="lvl2verify.php">
         <i class='bx bx-file' ></i>
         <span class="links_name">Verify Form</span>
       </a>
       <span class="tooltip">Verify Form</span>
     </li>
      <li>
       <a href="level_2_authorizeemployee.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Authorize Employee</span>
       </a>
       <span class="tooltip">Authorize Employee</span>
     </li>
	<?php }elseif($authType == "Level-3 Officer"){?>
		<a href="lvl3verify.php">
         <i class='bx bx-file' ></i>
         <span class="links_name">Verify Form</span>
       </a>
       <span class="tooltip">Verify Form</span>
     </li>
      <li>
       <a href="level_3_authorizeemployee.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Authorize Employee</span>
       </a>
       <span class="tooltip">Authorize Employee</span>
     </li>
	 <?php }elseif($authType == "Level-1 Officer"){?>
		<a href="lvl1verify.php">
         <i class='bx bx-file' ></i>
         <span class="links_name">Verify Form</span>
       </a>
       <span class="tooltip">Verify Form</span>
     </li>
	<?php }?>
     <li>
       <a href="#">
         <i class='bx bx-chat' ></i>
         <span class="links_name">Emergency Alert</span>
       </a>
       <span class="tooltip">Emergency Alert</span>
     </li>
	 <li>
       <a href="renewList.php">
         <i class='bx bx-timer' style="font-size:28px" ></i>
         <span class="links_name">Pending Renewal List</span>
       </a>
       <span class="tooltip">Pending Renewal List</span>
     </li>
	 <li>
       <a href="Search.php">
         <i class='bx bx-pie-chart-alt-2' ></i>
         <span class="links_name">Search</span>
       </a>
       <span class="tooltip">Search</span>
     </li>
     <li>
       <a href="level_3_upload_notice.php">
         <i class='bx bx-file' ></i>
         <span class="links_name">Upload Notices</span>
       </a>
       <span class="tooltip">Upload Notices</span>
     </li>
     <li>
       <a href="feedlist.php">
         <i class='bx bx-chat' ></i>
         <span class="links_name">Messages</span>
       </a>
       <span class="tooltip">Messages</span>
     </li>
      <?php if($authType == "Level-2 Officer"){?>
        <li>
       <a href="level_2_service_dashboard.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
      <?php }elseif($authType == "Level-3 Officer"){?>
        <li>
       <a href="level_3_service_dashboard.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
      <?php }elseif($authType == "Level-1 Officer"){?>
        <li>
       <a href="level_1_service_dashboard.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
	<?php }?>
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
	if ($form=="")
	{
		?>
			<h1 style="text-align: center;font-size: 40px;">Nothing to Authorize</h1>
		<?php	
	}
	else
	{
		echo $form;
	}
	?>
	</section>
</body>
<script src="javascript/script4.js"></script>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap');

html
{
	/*background-image: linear-gradient(to bottom right, #43cea259 , #185a9d78 );*/
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
    background-image: radial-gradient(rgb(185 219 44)40%,#d7ffc6 200%);
    background-size: cover;
    background-position: bottom;
    line-height: 1.6em;
    margin: 0;
    /* backdrop-filter: blur(5px); */
    box-shadow: rgb(185 219 44) 1px 6px 20px 5px;
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
.nav_left
{
	display: inline-flex;
	width: 50%
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
nav a:hover
{
	font-weight: bolder;
}
a
{
	text-decoration: none;
	color: black;
	display: inherit;
}
.container
{	
	font-size: 1.7em;
	display: inline-block;
}

input,select
{
	padding:15px;
	width:350px ;
	font-size: 35px;
	background: #ececec ;
	border: 0px solid black; 
	outline: none;
	border-radius: 5px;
	transition-delay: 0.15s;
	background: transparent;
	color: black;
}
label
{
	font-size: 25px;
	line-height: 40px;
	width: 200px;
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
.user input
{
	padding: 0px;
}
.formCont
{
	display: inline-block;
	width: 45%;
	margin-bottom: 10px;
}
.cont
{	
	margin: auto;
	text-align: left;
	width: 400px;
}
.EachAuth
{	
	text-align: center;
	background:white;
	margin: 50px;
	margin-top: 20px;
	color: black;
	padding: 20px;
	padding-bottom: 0px;
	padding-top: 30px;
	box-shadow: -5px 5px 10px black;
}

.EachAuth input,select
{
	outline: none;
	border: 0px solid black;
	transition-delay: 0.15s;
	padding: 7px;
	width: 400px;
	font-size: 18px;
	border-radius: 10px;
	outline: none;
	background: white;
}
input.submit
{
    width: 250px;
    background-color: #4ea5ff;
    border: none;
    outline: none;
    height: 50px;
    font-size: 25px;
    border-radius: 49px;
    color: #fff;
    cursor: pointer;
    transition: 0.5s;
    padding: 0px;
    border-radius: 10px;
	text-align:center;
}
input.submit:hover
{
	background: #0066ff;
	cursor: pointer;
    
}
.invis
{
	position: absolute;
	left: -1700px;	
}

@media screen and (max-width:1000px)
{
  .formCont
	{	
		display: block;
		width: 100%;
	}
	
}
@media screen and (max-device-width: 900px)
{
  .formCont
	{	
		display: inline-block;
		width: 45%;
	}
	.EachAuth input,select
	{	
		width: 350px;
		margin-right: 50px;
	}
}
/*@media screen and (max-width: 900px)
{
	.details label
	{
		font-size: 25px;
	}
	.details input
	{
		font-size: 25px;
		width: 190px;
	}
	.list li
	{
		margin-bottom: 80px;
	}
}*/
/*@media screen and (max-device-width: 900px)
{		
	.details input
	{
		font-size: 35px;
		width: 350px;
	}
	.list li
	{
		margin-bottom: 80px;
	}
	.list
	{
		padding-left: 50px;
	}
}*/
</style>
<script type="text/javascript">
	const btn = document.querySelector("#sub");
	const year = document.querySelector("#year");
	d = new Date();
	var minute , hour ;
	const date = document.querySelectorAll(".Ldate");
	for (var i = date.length - 1; i >= 0; i--)
	{
		date[i].valueAsDate = new Date();
	}
	console.log(date);
	const time = document.querySelectorAll(".time");
	if (d.getMinutes()<10)
	{
		minute = "0"+d.getMinutes();
	}
	else
	{
		minute = d.getMinutes();	
	}
	if (d.getHours()<10)
	{
		hour = "0"+d.getHours();
	}
	else
	{
		hour = d.getHours();
	}
	for (var i = time.length - 1; i >= 0; i--) {
		time[i].value = hour+":"+minute;
	}
</script>
</html>