<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="css/style.css" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
  <?php
  session_start();
	$msg="";
	if(!empty($_REQUEST['msg'])){
		$msg=$_REQUEST['msg'];
	}
?>
    <div class="return">
      <a href="sesdestroy.php">
        <img src="images/return.svg" class="returnImg">
        <img src="images/returnHover.svg" class="ImgHover">
      </a>
    </div>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="verify.php" class="sign-in-form" method="POST">
            <h2 class="title">Verify your account</h2>
            <?php if($msg!=""){ ?><div class="error-text" style="text-align: center; color: #fff;background: #4ea5ff;padding: 8px 10px;border-radius: 5px;margin-bottom: 10px;border: 1px solid rgb(0, 69, 133);"><?php echo $msg?> </div><?php }?>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="text" name="otp" placeholder="Enter your OTP" />
            </div>
            <input type="submit" value="Submit" class="btn solid" />
          </form>
        </div>
      </div>
      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Verify your Account,</h3><h1>with OTP</h1><br>
          </div>
          <img src="images/otp.png" class="image" alt="" style="width:70%"/>
        </div>
      </div>
    </div>

    <script src="javascript/script3.js"></script>
  </body>
</html>
