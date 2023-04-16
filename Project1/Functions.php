<?php
	function PwdMatch($Password , $RePass)
	{
		if ($Password==$RePass)
		{
			$result = true;
		}
		else
		{
			$result = false;
		}

		return $result;
	}

	function LogIn($name , $password , $posts )
	{	
		$result = false;
		foreach ($posts as $post) 
			{	
				if ($name == $post['Name']&&$password == $post['Password']) 
				{	
					$result = true;
					break;
				}
			}
		return $result;
	}

	function LogInUser($name , $password , $posts , $date , $time , $conn)
	{	
		$result = false;
		foreach ($posts as $post) 
			{	
				if ($name == $post['Name']&&$password == $post['Password']) 
				{	
					if ($post["Type"]=='DFO'||$post["Type"]=='FEO'||$post["Type"]=='ADF'||$post["Type"]=='FFA')
					{
						if ($post['Auth']=='Y')
						{
							$_SESSION["Username"] = $name;
							$_SESSION["Type"] = $post['Type'];
							$_SESSION["District"] = $post['District'];
							$_SESSION["ID"] = $post['ID'];
							$ID = $post['ID'];
							$uquery=" UPDATE `users` SET `LoginDate` = '$date', `LoginTIme` = '$time' WHERE `users`.`ID` = '$ID'";
						}
						else
						{
							$result = false;
							header("Location: ".ROOT_URL.'/Login.php?error=NotAuth');
							exit();
						}
					}
					else
					{
						$_SESSION["Username"] = $name;
						$_SESSION["Type"] = $post['Type'];
						$_SESSION["District"] = $post['District'];
						$_SESSION["ID"] = $post['ID'];
						$ID = $post['ID'];
						$uquery=" UPDATE `users` SET `LoginDate` = '$date', `LoginTIme` = '$time' WHERE `users`.`ID` = '$ID'";
					}
					if( mysqli_query($conn,$uquery))
					{
						$result = true;
					}
					else
					{
						echo mysqli_error($conn);
						$result = false;
					}
					break;
				}
			}
		return $result;
	}

	function AuthTime($ID , $date , $time , $conn)
	{	
			
		$uquery=" UPDATE `users` SET `AuthDate` = '$date', `AuthTime` = '$time' WHERE `users`.`ID` = '$ID'";
		if( mysqli_query($conn,$uquery))
		{
			$result = true;
		}
		else
		{
			echo mysqli_error($conn);
		}

		return $result;
	}

	function PassChng($name , $password , $posts , $RePass , $newPass , $date , $time , $conn )
	{
		if(LogIn($name , $password , $posts )!=False)
		{
			if(PwdMatch($newPass , $RePass))
			{

				foreach ($posts as $post) 
				{	
					if ($name == $post['Name']&&$password == $post['Password']) 
					{	
						$ID = $post['ID'];
						$uquery=" UPDATE `users` SET `PwChDt` = '$date', `PwChTime` = '$time' WHERE `users`.`ID` = '$ID' ";
						if( mysqli_query($conn,$uquery))
						{
							$result = true;
						}
						else
						{
							echo mysqli_error($conn);
						}
						break;
					}
					
				}
			}
			else
			{
				$result = false;
				header("Location: ".ROOT_URL.'/PassChng.php?error=PwdMatch');
				exit();
			}
		}
		else
		{
			$result = false;
			header("Location: ".ROOT_URL.'/PassChng.php?error=LogIn');
			exit();
		}
		return $result ;
	}

	function upload($Photo)
	{
		$target_dir = "";
		$target_file = $target_dir . basename($_FILES["$Photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["$Photo"]["tmp_name"]);
		if($check !== false)
		{
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		}
		else
		{
			echo "File is not an image.";
			$uploadOk = 0;
		}
		if ($uploadOk == 0)
		{
			

		} 
		else 
		{
			if (move_uploaded_file($_FILES["$Photo"]["tmp_name"], $target_file))
			{
				 htmlspecialchars( basename( $_FILES["$Photo"]["name"])). " has been uploaded.";
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
	function uploadPDF($Photo)
	{
		$target_dir = "./notices/";
		$target_file = $target_dir . basename($_FILES["$Photo"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["$Photo"]["tmp_name"]);
		if ($uploadOk == 0)
		{
			

		} 
		else 
		{
			if (move_uploaded_file($_FILES["$Photo"]["tmp_name"], $target_file))
			{
				 htmlspecialchars( basename( $_FILES["$Photo"]["name"])). " has been uploaded.";
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
?>