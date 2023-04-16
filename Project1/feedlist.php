<?php
	require('config.php');
	session_start();
	error_reporting(1);
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
	$authBy = $_SESSION['Username'];
	$details = $_SESSION["Username"]." - ".$_SESSION["Type"];
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
	function dateFormat($date)
	{
		$ddmmyy = $date[8].$date[9].$date[7].$date[5].$date[6].$date[4].$date[2].$date[3];

		return $ddmmyy;
	}

	$resultform = "";

		$district = $currDistrict;
		if($authType == 'Level-3 Officer'){
			$query = " SELECT DISTINCT `ID` FROM `feedback` ORDER BY `Slno` DESC";
		}
		else{
			$query = " SELECT DISTINCT `ID` FROM `feedback` WHERE `District` = '$district' ORDER BY `Slno` DESC";
		}
		$result = mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		foreach ($posts as $post)
		{	
			$idquery = " SELECT * FROM `feedback` WHERE `ID`= ".$post['ID']." ORDER BY `Slno` DESC";
			$idresult = mysqli_query($conn,$idquery);
			$idposts = mysqli_fetch_all($idresult,MYSQLI_ASSOC);
			$namequery = " SELECT * FROM `reg_tb` WHERE `id`= ".$post['ID'];
			$nameresult = mysqli_query($conn,$namequery);
			$nameposts = mysqli_fetch_all($nameresult,MYSQLI_ASSOC);
			$idpost = $idposts[count($idposts)-1];
			$resultform.=  
				"<a href='feedback.php?ID=".$idpost["ID"]. "'>		
				<div class='bg'>
					<div class='details'><strong>" .$nameposts[0]["name"]. "," .$nameposts[0]["district"]. "</strong></div>
					<div class='date'>" .dateFormat($idposts[0]["Date"])."</div>
					<div class='msg'><span>" .$idposts[0]["Sendername"].":</span> " .$idposts[0]["Message"]."</div>					
				</div>
				</a>
				";
		}


	


?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
	<link rel="stylesheet" href="css/feedlist.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<?php if($authType == "Hatchery Owner"){?>
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
       <a href="#">
	   <i class='bx bx-certification' ></i>
         <span class="links_name">Accreditation Certificate</span>
       </a>
       <span class="tooltip">Accreditation Certificate</span>
     </li>
     <li>
       <a href="#">
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
       <a href="#">
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
  <?php }else {?>
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
       <a href="#">
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
  <?php } ?>
  <section class="home-section">
	<div class="inform">
	<form method="POST" action="Search.php">
		<?php
			echo $resultform;
		?>
	</form>
</div>
</section>

  <script src="javascript/script4.js"></script>
</body>
</html>
<style type="text/css">
</style>
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
</html>