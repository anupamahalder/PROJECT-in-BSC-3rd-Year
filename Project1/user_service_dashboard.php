<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
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
    
  </section>

  <script src="javascript/script4.js"></script>

</body>
</html>
