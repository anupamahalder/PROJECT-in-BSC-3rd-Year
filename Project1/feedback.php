<?php
	require('config.php');
	session_start();
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
	error_reporting(1);
	$authBy = $name;
	// $details = $_SESSION["Username"]." - ".$_SESSION["Type"];
	$authType = $type;

	if ($type == 'Hatchery Owner')
	{
		$id = $_SESSION['id'];
		$YN = 'N';
	}
	else
	{
		$id = $_GET['ID'];
		$YN = 'Y';
	}
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

	$resultconv = "";
	$i=0;

	if (filter_has_var(INPUT_POST, 'Submit'))
	{
		

		$district = $currDistrict;
		$date = $_POST['date'];
		$time = $_POST['time'];
		$reply = $_POST['reply'];
		$senderid = $_SESSION['id'];
		$query = "INSERT INTO `feedback`(`ID`, `SenderID`, `Sendername`, `District`, `Message`, `Type`, `Date`, `Time`, `Reply`) VALUES ('$id', '$senderid', '$authBy', '$district', '$reply','$type', '$date', '$time', '$YN') ";
		if (mysqli_query($conn,$query))
		{
			header("Location:http://localhost/hatchery_project/Project1/feedback.php?ID=".$id );
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
	
	$msgquery = " SELECT * FROM `feedback` WHERE `ID` = '$id' ORDER BY `Slno` ASC";
	$result = mysqli_query($conn,$msgquery);
	$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
	$bg = 'white';
	foreach ($posts as $post)
	{		

			if ($post['Type']=='Hatchery Owner')
			{
				$bg = 'blue';
			}
			if ($post['Type']=='Level-1 Officer')
			{
				$bg = 'green';
			}
			if ($post['Type']=='Level-2 Officer')
			{
				$bg = 'yellow';
			}
			if ($post['Type']=='Level-3 Officer')
			{
				$bg = 'red';
			}

			$resultconv.="<p class=' ".$bg."'>

								<span class='sender'>".$post['Sendername']." , ".$post['Type']."</span><br><br>
								<span class='msg'>".$post['Message']."</span><br>
								<span class='msgdate'>".dateFormat($post['Date'])." , ".$post['Time'].

						 "</span></p>";
			
	}
	function dateFormat($date)
	{
		$ddmmyy = $date[8].$date[9].$date[7].$date[5].$date[6].$date[4].$date[2].$date[3];

		return $ddmmyy;
	}

?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
	<link rel="stylesheet" href="css/feedback.css">
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
  <?php } ?>
  <section class="home-section">

<div class="conv">
	<?php
		echo $resultconv;
	?>
</div>
<form method="POST" action="feedback.php?ID=<?php echo$id ?>">
	<textarea name="reply" autofocus placeholder="Type your feedback here"></textarea>
	<div class="invis">
			<input type="date" value="" name="date" class="Ldate">
			<input type="text" value="" name="time"	class="time">
	</div>
	<input  type="submit" class="submit" name="Submit" value="Send">
</form>

</section>

  <script src="javascript/script4.js"></script>
</body>
</html>
<script type="text/javascript">

	d = new Date();
	var minute , hour ;
	const date = document.querySelector(".Ldate");
	date.valueAsDate = new Date();
	console.log(date);
	const time = document.querySelector(".time");
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
	time.value = hour+":"+minute;

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

	var element = document.querySelector('.conv');
	element.scrollTop = element.scrollHeight;
		
		

</script>
</html>