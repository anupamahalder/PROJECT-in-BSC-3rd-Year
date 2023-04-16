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
  $authType = $type;
  require('Functions.php');

  if(filter_has_var(INPUT_POST, 'Submit'))
	{	

		$File = $_FILES['File']["name"];
    $getdate= date("Y-m-d");
    $gettime=date("H:i:sa");
		$query = "INSERT INTO `notice_tb`(`Notice`, `Uploader`, `Date`) VALUES ('$File','$name','$getdate')  ";
    echo $query;
		if( mysqli_query($conn,$query))
		{	
			uploadPDF('File');
			header("Location:http://localhost/hatchery_project/Project1/level_3_upload_notice.php");
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
    <link rel="stylesheet" href="css/notice.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
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
       <a href="#">
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
  <section class="home-section" style="text-align: center;">
  <form action="level_3_upload_notice.php" method="POST"  enctype="multipart/form-data">
    <input type="file" id="myPdf" name="File" required /><br>
    <input type="submit" name="Submit" class="submit" value="Upload File">
  </form>
<canvas id="pdfViewer"></canvas>
  </section>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src='https://mozilla.github.io/pdf.js/build/pdf.js'></script><script  src="./javascript/script5.js"></script>

  <script src="javascript/script4.js"></script>
</body>
</html>

