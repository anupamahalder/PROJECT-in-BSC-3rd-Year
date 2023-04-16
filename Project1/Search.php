<?php
	require('config.php');
	session_start();
	error_reporting(1);
	// if ($_SESSION["Type"]!='DFO'&&$_SESSION["Type"]!='FEO'&&$_SESSION["Type"]!='FFA'&&$_SESSION["Type"]!='ADF'&&$_SESSION["Type"]!='JDF'&&$_SESSION["Type"]!='Member Secretary')
	// {	
	// 	header("Location: ".ROOT_URL.'/Login.php');
	// }
	// $level = true;
	// if ($_SESSION["Type"]=='ADF'||$_SESSION["Type"]=='JDF')
	// {
	// 	$level = false;
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
	$details = $_SESSION["Username"]." - ".$_SESSION["Type"];
	$authBy = $name;
	$authType = $type;
	$max = false;
	$min = false;
	$nodata = false;

	$disOptions = '';
	$diquery=" SELECT * FROM `districts`";
	$diresult = mysqli_query($conn,$diquery);
	$diposts = mysqli_fetch_all($diresult,MYSQLI_ASSOC);
	mysqli_free_result($diresult);
	foreach ($diposts as $dipost)
	{	
		$typeOp = $dipost["District"];
		if ($_SESSION['District']==$dipost["District"])
		{
			$disOptions .= "<option value='$typeOp' selected>".$dipost["District"]."</option>";
		}
		else
		{
			$disOptions .= "<option value='$typeOp'>".$dipost["District"]."</option>";
		}
	}


	function Oaddress($post)
	{	
		$addr = "".$post["Owner's Block"]." \n"  .$post["Owner's GP"]."\n" .$post["Owner's Village"]."\n"  .$post["Owner's Post Office"]."\n"  .$post["Owner's Police Station"]."\n" .$post["Owner's PIN"]." " ; 
 
		return $addr;
	}
	function Haddress($post)
	{	
		$addr = $post["Hatchery Name"]."\n".$post["Hatchery Block"]." \n"  .$post["Hatchery GP"]."\n" .$post["Hatchery Village"]."\n"  .$post["Hatchery Post Office"]."\n"  .$post["Hatchery Police Station"]."\n" .$post["Hatchery PIN"]." " ; 
 
		return $addr;
	}

	$resultform = "<br>
					<p class='error'>No Result Found</p>";
	$i=0;

	if (filter_has_var(INPUT_POST, 'Search'))
	{
		if (!($authType=='Level-3 Officer'))
		{
			$district = $currDistrict;
		}
		else
		{
			$district = $_POST['District'];
		}
		$accNo = $_POST['AccNo'];
		$hatchery = $_POST['Hatchery'];
		$owner = $_POST['Owner'];
		$condition = " `Current`='Y' ";
		$resultform='';
		$i=1;
		if ($district!='')
		{
			$condition .= " AND `Hatchery District` ='$district' ";
		}
		if ($accNo!='')
		{
			$condition .= " AND `Acc No` LIKE '%$accNo%' ";
		}
		if ($hatchery!='')
		{
			$condition .= " AND `Hatchery Name` LIKE '%$hatchery%' ";
		}
		if ($owner!='')
		{
			$condition .= " AND `Owner's Name` LIKE '%$owner%' ";
		}
		$i=1;
		$query = " SELECT * FROM `hatchery` WHERE ".$condition." AND `Acc No`!='ACR-0'";
		$result = mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		foreach ($posts as $post)
		{	

				$resultform.=  "<div class='bg'>	
			<div class='formCont' style='width: 15%; margin-left:25px;'>
				<div style='position: absolute; font-size: 1.8em;left: 30px;'><strong>".$i."</strong></div>
				<p><img id='output' src='" .$post["Owner's Photo"]. "'></p>
			</div>
			<div class='formCont'>
				<div class='duocont'>
					<div class='cont'><label>District : </label></div>
					<input value='" .$post["Hatchery District"]. "'  readonly>
					<div class='cont'><label>Accreditation : </label></div>
					<input readonly type='text' value='" .$post["Acc No"]. "'  maxlength='40' >
				</div><br>
				<div class='duocont'>
					<div class='cont'><label>Hatchery : </label></div>
					<input readonly type='text' value='" .$post["Hatchery Name"]. "'  maxlength='40' >
					<div class='cont'><label> Owner's Name :  </label></div>
					<input readonly type='text' value='" .$post["Owner's Name"]. "'  maxlength='40'>
					<input readonly class='invis' type='text' value='" .$post["ID"]. "'  maxlength='40'>
				</div>
			</div>
				<div class='formCont' style='width:200px;'>
					<a href='./viewDetails.php?ID=".$post["ID"]. "' target='_blank'><input readonly type='text' class='submit' name='View' value='View' style='width:-webkit-fill-available'>
					</a>
				</div>
			</div>
				";
				$i=$i+1;
		}
		$i=$i-1;
				
	}

	


?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
	<link rel="stylesheet" href="css/search.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> 
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
	<div class="inform">
	<form method="POST" action="Search.php">
		<div class="formCont id">
			<div class="container">
				<div class="cont"><label>District : </label></div>
				<select name="District" class="type" 
				<?php
				if (!($authType=='Level-3 Officer'))
				{
					echo "disabled";
				}
				?>
				>
				<option value=""></option>	
				<?php
				echo $disOptions;
				?>
				</select>
			</div>	
			<div class="container">	
				<div class="cont"><label>Accreditation No : </label></div>
				<input  type="text" name="AccNo"   maxlength="40" value="<?php echo !empty($_POST["AccNo"])?($_POST["AccNo"]):"" ?>">
			</div>
			<div class="container">
				<div class="cont"><label>Hatchery Name : </label></div>
				<input  type="text" name="Hatchery"   maxlength="40" value="<?php echo !empty($_POST["Hatchery"])?($_POST["Hatchery"]):"" ?>">
			</div>
			<div class="container">	
				<div class="cont"><label> Owner's Name :  </label></div>
				<input  type="text" name="Owner"  maxlength="40" value="<?php echo !empty($_POST["Owner"])?($_POST["Owner"]):"" ?>">
			</div>
			<div class="container sub">	
				<input  type="submit" class="submit" name="Search" value="Search"  maxlength="40">
			</div>
		</div>
		<hr>
		<?php
		if ($resultform==''){
			echo "	<br>
					<p class='error'>No Result Found</p>
				"; 	
		 }else{
		 	echo "	<br>
					<p class='succ'>".$i." Results Found</p>
				";
		 }
		?>
		<?php
			echo ($resultform);
		?>
	</form>
</div>
</section>

  <script src="javascript/script4.js"></script>

</body>
</html>
<script type="text/javascript">

	const imges = document.querySelectorAll('#outut')
	console.log(imges);
	for (var i = imges.length - 1; i >= 0; i--) {

		imges[i].onclick = function(event){

		console.log(event.target)

		if (!(event.target.classList.contains('big'))){

			event.target.style.position='fixed';
			event.target.style.top='50px';
			event.target.style.left='50px';
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