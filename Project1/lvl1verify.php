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
	if (empty($_POST['ID'])) {

		$ID = 0;
		$IDquery="SELECT MIN(`ID`) AS 'curr' FROM `hatchery` WHERE `ID`>='$ID' AND `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
		$IDresult = mysqli_query($conn,$IDquery);
		$IDposts = mysqli_fetch_all($IDresult,MYSQLI_ASSOC);
		mysqli_free_result($IDresult);
		if (empty($IDposts[0]['curr'])){
			$nodata = true;
		}

		$currentID = $IDposts[0]['curr'];
		$query = " SELECT * FROM `hatchery` WHERE `ID` = $currentID ";
		$result = mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$post = $posts[0];
		$OwnerAdd = Oaddress($post);
		$HatcheryAdd = Haddress($post);
	}
	else{
		$ID = $_POST['ID'];
	}

	if (filter_has_var(INPUT_POST, 'Next'))
	{
		$IDquery="SELECT MIN(`ID`) AS 'curr' FROM `hatchery` WHERE `ID`>'$ID' AND `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
		$IDresult = mysqli_query($conn,$IDquery);
		$IDposts = mysqli_fetch_all($IDresult,MYSQLI_ASSOC);
		mysqli_free_result($IDresult);

		$currentID = $IDposts[0]['curr'];
		$query = " SELECT * FROM `hatchery` WHERE `ID` = $currentID ";
		$result = mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$post = $posts[0];
		$OwnerAdd = Oaddress($post);
		$HatcheryAdd = Haddress($post);		
	}
	if (filter_has_var(INPUT_POST, 'Prev'))
	{
		$IDquery="SELECT MAX(`ID`) AS 'curr' FROM `hatchery` WHERE `ID`<'$ID' AND `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
		$IDresult = mysqli_query($conn,$IDquery);
		$IDposts = mysqli_fetch_all($IDresult,MYSQLI_ASSOC);
		mysqli_free_result($IDresult);

		$currentID = $IDposts[0]['curr'];
		$query = " SELECT * FROM `hatchery` WHERE `ID` = $currentID ";
		$result = mysqli_query($conn,$query);
		$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
		$post = $posts[0];
		$OwnerAdd = Oaddress($post);
		$HatcheryAdd = Haddress($post);		
	}
	if (filter_has_var(INPUT_POST, 'Verify'))
	{
		$ID = $_POST['ID'];
		$date = $_POST['date'];
		var_dump($_POST);
		$authquery = "UPDATE `hatchery` SET `Acc DFO` = '$authBy',`DFO date` = '$date' WHERE `ID` = '$ID'";
		if( mysqli_query($conn,$authquery))
		{	
			$maxIDquery="SELECT MAX(`ID`) AS 'maxid' FROM `hatchery` WHERE `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
			$maxIDresult = mysqli_query($conn,$maxIDquery);
			$maxIDposts = mysqli_fetch_all($maxIDresult,MYSQLI_ASSOC);
			mysqli_free_result($IDresult);
			if ($maxIDposts[0]['maxid']==$currentID){
				$max = true;
			}	
			if ($max = true) {
				header("Location: ./lvl1verify.php");
			}
			else{
				$IDquery="SELECT MIN(`ID`) AS 'curr' FROM `hatchery` WHERE `ID`>'$ID' AND `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
				$IDresult = mysqli_query($conn,$IDquery);
				$IDposts = mysqli_fetch_all($IDresult,MYSQLI_ASSOC);
				mysqli_free_result($IDresult);

				$currentID = $IDposts[0]['curr'];
				$query = " SELECT * FROM `hatchery` WHERE `ID` = $currentID ";
				$result = mysqli_query($conn,$query);
				$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
				$post = $posts[0];
				$OwnerAdd = Oaddress($post);
				$HatcheryAdd = Haddress($post);
			}
			
		}	
		else
		{
			echo mysqli_error($conn);
		}
		
	}
	if (filter_has_var(INPUT_POST, 'Cancel'))
	{	
		echo "success";
		$ID = $_POST['ID'];
		$date = $_POST['date'];
		$remarks = $_POST['remarks'];
		$authquery = "UPDATE `hatchery` SET `Acc DFO` = 'canceled',`DFO date` = '$date',`Remarks` = '$remarks' WHERE `ID` = '$ID'";
		echo $authquery;
		if( mysqli_query($conn,$authquery))
		{	
			$maxIDquery="SELECT MAX(`ID`) AS 'maxid' FROM `hatchery` WHERE `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
			$maxIDresult = mysqli_query($conn,$maxIDquery);
			$maxIDposts = mysqli_fetch_all($maxIDresult,MYSQLI_ASSOC);
			mysqli_free_result($IDresult);
			if ($maxIDposts[0]['maxid']==$currentID){
				$max = true;
			}
			if ($max = true) {
				header("Location: ./lvl1verify.php");
			}
			else{
				$IDquery="SELECT MIN(`ID`) AS 'curr' FROM `hatchery` WHERE `ID`>'$ID' AND `Current`='Y' AND `Hatchery District`='$currDistrict' AND `ACC DFO`='';";
				$IDresult = mysqli_query($conn,$IDquery);
				$IDposts = mysqli_fetch_all($IDresult,MYSQLI_ASSOC);
				mysqli_free_result($IDresult);

				$currentID = $IDposts[0]['curr'];
				$query = " SELECT * FROM `hatchery` WHERE `ID` = $currentID ";
				$result = mysqli_query($conn,$query);
				$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
				$post = $posts[0];
				$OwnerAdd = Oaddress($post);
				$HatcheryAdd = Haddress($post);
			}
		}
		else
		{
			echo mysqli_error($conn);
		}
	}
	$maxIDquery="SELECT MAX(`ID`) AS 'maxid' FROM `hatchery` WHERE `Current`='Y' AND `Hatchery District`='$currDistrict'  AND `ACC DFO`='';";
	$maxIDresult = mysqli_query($conn,$maxIDquery);
	$maxIDposts = mysqli_fetch_all($maxIDresult,MYSQLI_ASSOC);
	mysqli_free_result($maxIDresult);
	if ($maxIDposts[0]['maxid']==$currentID){
		$max = true;
	}
	$minIDquery="SELECT MIN(`ID`) AS 'minid' FROM `hatchery` WHERE `Current`='Y' AND `Hatchery District`='$currDistrict'  AND `ACC DFO`='';";
	$minIDresult = mysqli_query($conn,$minIDquery);
	$minIDposts = mysqli_fetch_all($minIDresult,MYSQLI_ASSOC);
	mysqli_free_result($minIDresult);
	if ($minIDposts[0]['minid']==$currentID){
		$min = true;
	}


?>
<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/c/CodingLabYT-->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Responsive Sidebar Menu</title>
    <link rel="stylesheet" href="css/style4.css">
	<link rel="stylesheet" href="css/verifyHatchery.css">
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
       <a href="lvl1verify.php">
         <i class='bx bx-file' ></i>
         <span class="links_name">Verify Form</span>
       </a>
       <span class="tooltip">Verify Form</span>
     </li>
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
     <li>
       <a href="level_1_service_dashboard.php">
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
	<div class="inform">
	<form method="POST" action="lvl1verify.php">
		<div class="formCont id">
			<div class="invis">
				<label>ID : </label>
				<input id="ID" type="number" value="<?php
			echo "$currentID"?>" readonly name="ID" maxlength="8" style='background: #ffffff2e; margin-right: 30px; '>
			</div>
			<input type="submit" border="0" class="prev" name='Prev' value=" "
			<?php
			if ($min==true){
				echo "disabled";
			}
			?>
			>
			<input type="submit" alt='submit'  class="next" name='Next' value=" "
			<?php
			if ($max==true){
				echo "disabled";
			}
			?>
			><br>
		</div>
		<hr>
		<div class="bg">
			<?php
		if ($nodata==true){
			echo "	<br>
					<p class='error'>No Applications Pending</p>
				"; 	
		 } 
		?>
		<div class="formCont">
			<p><img id="output" src="<?php echo($post ["Owner's Photo"]) ?>" alt='Owners Photo'></p>
		</div>
		<div class="formCont">
			<div class="cont"><label>Hatchery Name : </label></div>
			<input readonly type="text" value="<?php echo($post ["Hatchery Name"]) ?>"  maxlength="40" ><br><br>
			<div class="cont"><label> Owner's Name :  </label></div>
			<input readonly type="text" value="<?php echo$post ["Owner's Name"] ?>"  maxlength="40">
		</div>
		<div class="formCont">
			<div class="cont"><label>Mobile 1 :</label></div>
		<input readonly type="text" value="<?php echo($post ["Phone 1"]) ?>"  maxlength="40">
		</div>
		<div class="formCont">
			<div class="cont"><label>Father's Name : </label></div>
			<input readonly type="text" value="<?php echo($post ["Father's Name"]) ?>"  maxlength="40">
		</div>
		<div class="formCont">
			<div class="cont"><label>Mobile 2 :  </label></div>
			<input readonly type="text" value="<?php echo($post ["Phone 2"]) ?>"  maxlength="40">
		</div>
		<div class="formCont">
			<div class="cont"><label>Email : </label></div>
			<input readonly type="text" value="<?php echo($post ['Email']) ?>"  maxlength="10">
		</div>
			<div class="formCont">
			<div class="cont"><label>Hatchery Address : </label></div>
		<textarea readonly="readonly"><?php echo($HatcheryAdd) ?></textarea>
		</div>
		<div class="formCont">
			<div class="cont"><label>Owner Address : </label></div>
			<textarea readonly="readonly"><?php echo($OwnerAdd) ?></textarea>
		</div>
		<div class="formCont">
			<div class="cont"><label>District : </label></div>
			<input value="<?php echo($post ['Hatchery District']) ?>"  readonly>
		</div>
		<div class="formCont">
			<div class="cont"><label>Application on : </label></div>
			<input readonly type="date" value="<?php echo($post ['App Date']) ?>">
		</div>
		<div class="formCont long">
			<div class="cont"><label>Remarks : </label></div>
			<input type="text" name="remarks" value="">
		</div>
		<div class="invis">
			<input type="date" value="" name="date" class="Ldate">
		</div>
		<br>
		<div class="formCont">
			<input type="submit" class="submit" name="Verify" value="Verify" 
			<?php
			if ($nodata==true){
				echo " disabled "; 	
			 } 
			//  if ($level==false){
			// 	echo " disabled "; 	
			//  } 
			?>>
		</div>
		<div class="formCont">
			<input type="submit" class="submit cancel" name="Cancel" value="Cancel"
			<?php
			if ($nodata==true){
				echo " disabled "; 	
			 }  
			?>
			>
		</div>
		<div class="formCont">
			<a href='<?php echo "./viewDetails.php?ID=".$currentID ?>' target="_blank"><input readonly type="text" class="submit view" name="View" value="View Details"
			<?php
			if ($nodata==true){
				echo " disabled "; 	
			 }  
			?>
			></a>
		</div>
		<div>
		</div>
		</div>
	</form>
</div>
  </section>

  <script src="javascript/script4.js"></script>

</body>
</html>
<script type="text/javascript">

	const date = document.querySelector(".Ldate");
	date.valueAsDate = new Date();

	const imges = document.querySelector('#output')
	console.log(imges);
	imges.onclick = function(event){

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
		

</script>