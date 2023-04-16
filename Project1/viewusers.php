<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  	<script type="text/javascript" language="netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.css"/>
 <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/b-1.5.4/b-html5-1.5.4/r-2.2.2/datatables.min.js"></script>

<script type="text/javascript">
console.log("js ready");
$(document).ready( function () {
    console.log("Jquery ready");
      $('#example').dataTable( {
        responsive: "true",
      
        } );
});
</script>
   </head>
<body>
    <?php
    session_start();
    include_once("config.php");
    $logid=$_SESSION["id"];
    $sql = "SELECT * from admin_tb WHERE id='".$logid."'";
    $result = mysqli_query($conn,$sql); 
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $name=$row['name'];
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
       <a href="viewemployee.php">
       <i class='bx bx-briefcase'></i>
         <span class="links_name">View Employee</span>
       </a>
       <span class="tooltip">View Employee</span>
     </li>
     <li>
       <a href="viewusers.php">
       <i class='bx bx-user' ></i>
         <span class="links_name">View Users</span>
       </a>
       <span class="tooltip">View Users</span>
     </li>
      <li>
       <a href="admin_authorize_employee.php">
         <i class='bx bx-check-square' ></i>
         <span class="links_name">Authorize Employee</span>
       </a>
       <span class="tooltip">Authorize Employee</span>
     </li>
     <li>
       <a href="viewlogins.php">
       <i class='bx bx-log-in-circle' ></i>
         <span class="links_name">View Logins</span>
       </a>
       <span class="tooltip">View Logins</span>
     </li>
     <li>
       <a href="viewDistrict.php">
       <i class='bx bx-map' ></i>
         <span class="links_name">View District</span>
       </a>
       <span class="tooltip">View District</span>
     </li>
     <li>
       <a href="viewfeedback.php">
         <i class='bx bx-chat' ></i>
         <span class="links_name">View Feedback</span>
       </a>
       <span class="tooltip">View Feedback</span>
     </li>
     <li>
       <a href="admin_service_dashboard.php">
         <i class='bx bx-cog' ></i>
         <span class="links_name">Setting</span>
       </a>
       <span class="tooltip">Setting</span>
     </li>
     <li class="profile">
         <div class="profile-details">
           <div class="name_job">
             <div class="name"><?php echo $name;?></div>
           </div>
           <a href="sesdestroy1.php"><i class='bx bx-log-out' id="log_out" ></i></a>
         </div> 
     </li>
    </ul>
  </div>
  <section class="home-section">
  <div class="content">
         <div class="header">
            <div class="logo">
               DEPARTMENT OF FISHERIES
            </div>
        </div>
            <table id="example" class="display" style="width:100%">
					<thead>
						<tr>
                			<th>Name</th>
                      <th>Type</th>
                			<th>Email</th>
                			<th>Phone Number</th>
                      <th>District</th>
						</tr>
					</thead>
					<tbody>
					<?php
                    $type="Hatchery Owner";
                    $astatus="NotVerified";
                    $sql      = "SELECT * FROM `reg_tb` WHERE type='".$type."'"; 
             			$result   = mysqli_query($conn,$sql);
                		if(mysqli_num_rows($result) > 0) 
						        {
                    		while($row = mysqli_fetch_assoc($result)) 
                    		{     
								echo '<tr>
								    <td>'.$row["name"].'</td>
                                    <td>'.$row["type"].'</td>
								    <td>'.$row["email"].'</td>
                                    <td>'.$row["phnum"].'</td>
								    <td>'.$row["district"].'</td>
								    </tr>';
							}
                		}
            		?> 
					</tbody>
		    </table>
        </div>
  </section>

  <script src="javascript/script4.js"></script>

</body>
</html>
