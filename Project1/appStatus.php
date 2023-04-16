<?php
	require('config.php');
	session_start();
	error_reporting(0);
	// if ($_SESSION["Type"]!='Hatchery Owner')
	// {	
	// 	header("Location: ".ROOT_URL.'/Login.php');
	// }
	$details = $_SESSION["Username"]." - ".$_SESSION["Type"];

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
	$period = "".dateFormat($post ['App Date']). " to " .dateFormat($post ['Acc Valid']);
	$renew = $post ['Acc Valid'];
	$renew = $valdate = date('d-m-y', strtotime($renew. ' + 1 days'));
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
	<link rel="stylesheet" href="css/appStatus.css">
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
     <!-- <li>
       <a href="#">
         <i class='bx bx-heart' ></i>
         <span class="links_name">Saved</span>
       </a>
       <span class="tooltip">Saved</span>
     </li>-->
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
  <div class="inform
<?php
	if($post['Acc JDF']=='')
	{
		echo " invis ";
	}
?>
">
	<form >
		<div class=" bg">
			<div class="formCont">
			<div class="cont"><label>Validity Period : </label></div>
			<input readonly type="text" value='<?php echo($period) ?>'>
			</div>
			<div class="formCont">
			<div class="cont"><label>Renewal Date : </label></div>
			<input readonly type="text" value='<?php echo($renew) ?>'>
			</div>
		</div>
	</form>
</div>
	<div class="status">
		<div class="contain">
			<div class="line">
				
			</div>
		</div>
		<ul>
			<li><div class="radio"><input type="radio" class="inRadio" disabled="disabled" 
				<?php
				if (!is_null($post)) {
					echo "checked";
				}
				?>
				>
				<span class="checkmark"></span>
			</div>
				<div class="text side"
				<?php
				if (!is_null($post)) {
					echo "style='color:green;background:#c7f8c7;'";
				}
				?>
				>Applied
				<?php
				if (!is_null($post)) {
					echo '<img src="images/yes.png" height="50" style="vertical-align:text-bottom;margin-right:20px;">';
				}
				else
				{
					echo '<img src="images/no.png" height="50" style="vertical-align:text-bottom;margin-right:20px">';
				}
				if (!is_null($post)) {
					echo '( '.dateFormat($post['App Date']).' )';
				}
				?>
			</div>
			<div class="aro">
				<img src="images/greenaro.png">
			</div>
			</li>
			<li><div class="radio"><input type="radio" class="inRadio" disabled="disabled" 
				<?php
				if ($post['Acc DFO']!='') {
					echo "checked";
				}
				?>
				>
				<span class="checkmark"></span>
				</div><div class="text" 
				<?php
				if ($post['Acc DFO']!='') {
					echo "style='color:green;background:#c7f8c7;'";
				}
				?>
				>Verified by Level-1 Officer
				<?php
				if ($post['Acc DFO']!='') 
				{
					echo '<img src="images/yes.png" height="50" style="vertical-align:text-bottom;margin-right:20px;">';
				}
				else
				{
					echo '<img src="images/no.png" height="50" style="vertical-align:text-bottom;margin-right:20px">';
				}
				if ($post['Acc DFO']!='') {
					echo '( '.dateFormat($post['DFO date']).' )';
				}
				?>
				</div>
				<div class="aro">
				<img src="images/greenaro.png">
				</div>
				</li>
			<li><div class="radio"><input type="radio" class="inRadio" disabled="disabled" 
				<?php
				if ($post['Acc ADF']!='') {
					echo "checked";
				}
				?>
				>
				<span class="checkmark"></span>
				</div><div class="text"
				<?php
				if ($post['Acc ADF']!=''){
					echo "style='color:green;background:#c7f8c7;'";
				}
				?>
				>Verified by Level-2 Officer
				<?php
				if ($post['Acc ADF']!='') 
				{
					echo '<img src="images/yes.png" height="50" style="vertical-align:text-bottom;margin-right:20px;">';
				}
				else
				{
					echo '<img src="images/no.png" height="50" style="vertical-align:text-bottom;margin-right:20px">';
				}
				if ($post['Acc ADF']!='') {
					echo '( '.dateFormat($post['ADF date']).' )';
				}
				?>
				</div>
				<div class="aro">
				<img src="images/greenaro.png">
				</div>
				</li>
			<li><div class="radio"><input type="radio" class="inRadio" disabled="disabled" 
				<?php
				if ($post['Acc JDF']!='') {
					echo "checked";
				}
				?>
				>
				<span class="checkmark"></span>
				</div><div class="text" 

				<?php
				if ($post['Acc JDF']!='') {
					echo "style='color:green;background:#c7f8c7;'";
				}
				?>

				>Verified by Level-3 Officer
				<?php
				if ($post['Acc JDF']!='') 
				{
					echo '<img src="images/yes.png" height="50" style="vertical-align:text-bottom;margin-right:20px;">';
				}
				else
				{
					echo '<img src="images/no.png" height="50" style="vertical-align:text-bottom;margin-right:20px">';
				}
				if ($post['Acc JDF']!='') {
					echo '( '.dateFormat($post['JDF date']).' )';
				}
				?>
				</div>
				<div class="aro">
				<img src="images/greenaro.png">
				</div>
				</li>
			<li><div class="radio"><input type="radio" class="inRadio" disabled="disabled" 
				<?php
				if ($post['Acc JDF']!='') {
					echo "checked";
				}
				?>
				>
				<span class="checkmark"></span>
				</div><div class="text"
				<?php
				if ($post['Acc JDF']!='') {
					echo "style='color:green;background:#c7f8c7;'";
				}
				?>
				>Certificate Generated
				<?php
				if ($post['Acc JDF']!='') 
				{
					echo '<img src="images/yes.png" height="50" style="vertical-align:text-bottom;margin-right:20px;">';
				}
				else
				{
					echo '<img src="images/no.png" height="50" style="vertical-align:text-bottom;margin-right:20px">';
				}
				if ($post['Acc JDF']!='') {
					echo '( '.dateFormat($post['JDF date']).' )';
				}
				?>
				</div></li>
		</ul>
	</div>
  </section>
  <script src="javascript/script4.js"></script>

</body>
</html>


<script type="text/javascript">
	
	const line = document.querySelector('.line');
	<?php
	$length = 0;
	if (!is_null($post))
	{
		$length = 1;
	}
	if ($post['Acc DFO']!='')
	{
		$length = 2;
	}
	if ($post['Acc ADF']!='')
	{
		$length = 3;
	}
	if ($post['Acc JDF']!='')
	{
		$length = 5;
	}
	?>
	line.style.backgroundImage="linear-gradient(to bottom, #00d440 <?php echo $length*20 ?>% , #ff0000 <?php echo $length*20 ?>%  )";

	var len = <?php echo $length ?>;
	console.log(len);


	const radio = document.querySelectorAll('.checkmark');
	console.log(radio[len]);



</script>

