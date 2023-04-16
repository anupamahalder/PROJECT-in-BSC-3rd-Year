<?php
	require('config.php');
	session_start();
	error_reporting(0);
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
	// if ($_SESSION["Type"]!='Hatchery Owner')
	// {	
	// 	header("Location: ".ROOT_URL.'/Login.php');
	// }
	// $details = $_SESSION["Username"]." - ".$_SESSION["Type"];

	require('Functions.php');

	$nodata = false;
	$ID = $logid;
	$query = " SELECT * FROM `hatchery` WHERE `ID` = $ID ";
	$result = mysqli_query($conn,$query);
	$posts = mysqli_fetch_all($result,MYSQLI_ASSOC);

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

	if (count($posts)==0)
	{
		$nodata = true;
	}
	else
	{
		$post = $posts[0];
	}
	if ($post ["Acc No"]=='ACR-0'||$nodata == true)
	{
		header("Location: error.php");
	}
	function dateFormat($date)
	{
		$ddmmyy = $date[8].$date[9].$date[7].$date[5].$date[6].$date[4].$date[2].$date[3];

		return $ddmmyy;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $post ["Acc No"]?></title>
</head>
<body>
<div class="btn">
	<?php
	if ($nodata == true)
	{
		echo "	<br>
			<p class='error'>No data exists apply for accreditation first</p>
		";
	}
	elseif ($check == false)
	{
		echo "	<br>
			<div class='error'>Form not Accreditated</div>
		";
	}
	else
	{
		echo "	<button onclick='window.print();' class='submit print'>Print  /  Save</button>
		";
	}

	?>
</div>
<div class="list">	
	<img src="./images/Certificate1.jpg">
	<img src="./images/Certificate2.jpg" style="position: relative;">
	<div class="text">
	<p>
		<?php
		echo "In terms of Notification No. 1953-Fish/C-IV/2L-1/2013 Dt. 09.09.2013 of Department of Fisheries, Aquaculture, Aquatic Resources and
		Fishing Harbours, Government of West Bengal the Hatchery/Seed Production unit of Sri/Smt <span>".$post ["Owner's Name"]."</span> 
		Son/Wife of <span>".$post ["Father's Name"]."</span>
		of Vill. <span>".$post ["Owner's Village"]."</span>
		PO <span>".$post ["Owner's Post Office"]."</span>
		District <span>".$post ["Owner's District"]."</span>
		accredited during <span>".$post ["Year"]."</span> Bearing No <span>".$post ["Acc No"]."</span>
		is hereby authorized to produce, sale or stock the following fish seed
		(Carps / Air breathing / Ornamental / Fresh water Prawn Shrimp
		.) in his/her/their hatchery/seed production unit <span>".$post ["Hatchery Name"]."</span>
		located at Vill <span>".$post ["Hatchery Village"]."</span>
		.
		P.S. <span>".$post ["Hatchery Police Station"]."</span>
		Р.О. <span>".$post ["Hatchery Post Office"]."</span>
		Block. <span>".$post ["Hatchery Block"]."</span>
		District <span>".$post ["Hatchery District"]."</span>
		subject to strict adherence of the condition laid down in Annexure of this certificate (over leaf) Spawn of <span> ".$post ["Species"]."</span>
		Post Larvae or
		Fry/Fingerlings of<span> ".$post ["Species"]."</span>";
		?>
	</p>
	</div>
	<div class="text2">
		<p><?php echo "8.<span style='margin-left:25px;'></span>This Certificate shall be valid upto   <span style='margin-left:5px;'> ".dateFormat($post ["Acc Valid"])."</span>" ?></p>
	</div>
</div>
</body>
<style type="text/css">
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Roboto&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Courgette&display=swap');


html
{
	/*background-image: linear-gradient(to bottom right, #43cea259 , #185a9d78 );*/
	background-image: url('bluebg.png');
	background-size: cover;
}
body
{	
	background: #00b1f1;
	margin: 0;
	min-height: 100vh;
	overflow-x: hidden;
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
	width: 70%;
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
h2
{
	font-family: 'Open Sans', sans-serif;
}
a
{
	text-decoration: none;
	padding: 10px;
	color:black;
	padding: 0px;
}
.list
{
	display: flex;
	flex-direction: column;
}
.list img
{
	min-width: 1600px;
	max-width: 1600px;
}
.list .text
{
	position: absolute;
    text-align: justify;
    /* background: #fffcd3; */
    background: transparent;
    color: black;
    font-size: 22px;
    max-width: 1300px;
    min-width: 1300px;
    transform: translate(150px, 450px);
    line-height: 40px;
}
.list .text2
{
	position: absolute;
    text-align: justify;
    /*background: #fffcd3;*/
    background: transparent;
    color: black;
    padding: 0px;
    font-size: 20px;
    max-width: 1100px;
    min-width: 1100px;
    transform: translate(133px, 1841px);
    line-height: 20px;
    font-weight: bold;
}
.text2 p
{
	margin: 0px;
}
.btn
{
	text-align: center;
}
.list span
{
	color: royalblue;
    font-weight: lighter;
    font-size: 1.4em;
    font-family: 'Courgette', sans-serif
}
.error
{	
    color: red;
    font-size: 3em;
    padding: 5px;
    font-weight: bold;
    background: white;
    box-shadow: -5px 5px 10px black;
    width: 90%;
    margin: auto;
    margin-bottom: 40px;
}
.print
{
	padding: 10px;
	width: 300px;
	margin: auto;
	margin: 10px;
	margin-top: 50px;
	font-size: 30px;
	background:white;
	color: black;
	font-family: "Open sans";
	font-weight: bold;
}
.print:hover
{
	background: black;
	color: white;
	border: 2px solid skyblue;
}
@media screen and (max-width: 900px)
{
	html
	{
		/*background-size:1000px;*/
		overflow:scroll;
	}
	body
	{
		overflow-x: scroll;
	}
}
@media screen and (max-device-width: 900px)
{		
	.box
	{
		margin-bottom: 70px;
	}
	nav p
	{
		line-height: 1.4em;
	}
	body
	{
		overflow-x: scroll;
	}
	.print
	{
		font-size: 3em;
	}
}
@media print
{
	body
	{
		size: landscape;
		background: rgb(0,175,240);
	}
	nav
	{
		display: none;
	}
	.print
	{
		display: none;
	}
	@page
	{
		border: 0px;
		size: a4 landscape;
		margin: 0px;
		-webkit-print-color-adjust: exact;
	}
}
</style>
<script type="text/javascript">
	
</script>
</html>
