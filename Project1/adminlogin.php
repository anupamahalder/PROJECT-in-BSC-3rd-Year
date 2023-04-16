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
	$msg="";
	if(!empty($_REQUEST['msg'])){
		$msg=$_REQUEST['msg'];
	}
?>
    <div class="return">
      <a href="index.php">
        <img src="images/return.svg" class="returnImg">
        <img src="images/returnHover.svg" class="ImgHover">
      </a>
    </div>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="adminloginreq.php" class="sign-in-form" method="POST">
            <h2 class="title">Log in</h2>
            <?php if($msg!=""){
                if($msg=="Registration Successful and Login Now"){
                ?><div class="succ-text" style="">
                <?php 
                echo $msg
                ?> </div>
            <?php }
              else{
            ?><div class="error-text" style="">
                <?php 
                echo $msg
                ?> </div>
            <?php }}?>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text"><a style="text-decoration: none" href="forgetpass.php">Forgot Your Password?</a></p>
          </form>
          <form action="signupreq.php" class="sign-up-form" method="POST">
            <h2 class="title">Sign up</h2>
            <?php if($msg!=""){ ?><div class="error-text" style=" color: #fff;background: #4ea5ff;padding: 8px 10px;border-radius: 5px;margin-bottom: 10px;border: 1px solid rgb(0, 69, 133);"><?php echo $msg?> </div><?php }?>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" name="name" placeholder="Full Name" required />
            </div>
            <div class="input-field">
              <i class="fas fa-phone fa-rotate-90"></i>
              <input type="number" name="phn" placeholder="Phone Number" required />
            </div>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <select class="userType" name="type" required>
                <option value="placeholder">User type</option>
                <option>Hatchery Owner</option>
                <option>Level-1 Officer</option>
                <option>Level-2 Officer</option>
                <option>Level-3 Officer</option>
                </select>
            </div>
            <div class="input-field">
              <i class="fas fa-map-marker"></i>
              <select class="district" name="district" required>
                <option value="placeholder">District</option>
                <option>Alipurduar</option>
                <option>Bankura</option>
                <option>Birbhum</option>
                <option>Cooch Behar</option>
                <option>Dakshin Dinajpur</option>
                <option>Darjeeling</option>
                <option>Hooghly</option>
                <option>Howrah</option>
                <option>Jalpaiguri</option>
                <option>Jhargram</option>
                <option>Kalimpong</option>
                <option>Kolkata</option>
                <option>Malda</option>
                <option>Murshidabad</option>
                <option>Nadia</option>
                <option>North 24 Parganas</option>
                <option>Paschim Bardhaman</option>
                <option>Paschim Medinipur</option>
                <option>Purba Bardhaman</option>
                <option>Purba Madinipur</option>
                <option>Purulia</option>
                <option>South 24 Parganas</option>
                <option>Uttar Dinajpur</option>
                </select>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" placeholder="Email" name="email" required/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" name="password" required />
            </div>
            <input type="submit" class="btn" value="Sign up" />
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
           
          </div>
          <img src="images/SignUp-Image.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="javascript/script3.js"></script>
  </body>
</html>
