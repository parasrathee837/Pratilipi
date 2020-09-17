<?php
ob_start();
session_start();
require_once 'config.php'; 
?>
<?php
if(isset($_POST['btnSubmit']))
{
   $exist_rows="select Id from tbl_users where User='".$_POST["name"]."'";
   $total_rows=mysqli_query($conn, $exist_rows);
   $num_rows=mysqli_num_rows($total_rows);
   if($num_rows<=0)
	{
   $sql = "INSERT INTO tbl_users(User,Password,CreatedDate)VALUES ('".$_POST["name"]."','".md5($_POST["password"])."','".date('Y-m-d')."')";

            if (mysqli_query($conn, $sql)) {
               $msg="<font color='green' size='3'><strong><center>Regsitered Successfully</center></strong></font>";
			
            } else {
               echo "Error: " . $sql . "" . mysqli_error($conn);
            }
            $conn->close();
	}
	else
	{
		  $msg="<font color='red' size='3'><strong><center>Username Already Exist</center></strong></font>";
	}
}
?>
<?php
if (isset($_POST['btnLogin']))
	{	

		// function to authenticate user		
		
			$password = md5($_POST['lpassword']);
	        $sqlQry = "SELECT * from tbl_users WHERE User = '$_POST[lname]' AND Password = '".$password."'";	
			$result =mysqli_query($conn,$sqlQry) or die('Error: ' . mysqli_error());
			$numRows = mysqli_num_rows($result);
			if ($numRows > 0)
			{
				if ($row= mysqli_fetch_array($result))
				{
						
						$_SESSION['USER'] = $row['User'];
						$_SESSION['ADMINID'] = $row['Id'];
					    header('Location:story.php');
				}
			}
			else
			{
					$msg = "<font color=red size='3'><b><center>Invalid Username / Password !</center></b></font>";
			}
		
	}
	?>
<html>
    <head>
        <title>login and register</title>
        <link rel="stylesheet" href="style.css">
		<script>
		function TestValidation()
		{
			if(document.getElementById('confirm_password').value !="" && (document.getElementById('password').value != document.getElementById('confirm_password').value))
			{
				document.getElementById("spnMessage").innerHTML = "Password and Confirm Password do not match";
				return false;
			}
		}
		</script>
	</head>
<body>
    <div class="hero">
        <div class="form-box">
            <div class="button-box"> 
                <div id="btn"></div>
                <button type="button" class="toggle-btn" onclick="login()">Log in</button>
                <button type="button" class="toggle-btn" onclick="register()">Register</button>
            </div> 
            <div class="social-icons">
                <a href="https://www.facebook.com/" target="_blank"><img src="fb.png" href></a>
                <a href="https://twitter.com/login" target="_blank"><img src="tw.png"></a>
                <a href="https://www.google.co" target="_blank"><img src="gp.png"></a>
            </div>
            <form method="POST" id="login" class="input-group">
			<?php if(isset($msg)) { echo $msg; } ?>
                 <input type="text" name="lname" class="input-field" autocomplete="off"  placeholder="Username" required>
                 <input type="password" name="lpassword" class="input-field" placeholder="Password" required>
                <!-- <input type="checkbox" class="check-box"><span>Remember password</span>-->
                  <input type="submit" name="btnLogin" class="submit-btn" value="Login">

            </form>
            <form  method="POST" id="register" class="input-group">
			<span id="spnMessage" style="color:red;font-size:14px;"></span>
                <input type="text" name="name" id="name" class="input-field" autocomplete="off" placeholder="Username" required>
                <input type="password" name="password" id="password" class="input-field" placeholder="Password" required>
				<input type="password" name="confirm_password" id="confirm_password" class="input-field" placeholder="Confirm Password" required>
				
                 <!--<input type="checkbox" class="check-box"><span> i agree to terms and conditions</span> -->
                <input type="submit" name="btnSubmit" class="submit-btn" value="Register" onclick="return TestValidation();">
                
           </form>
       
        </div>  
          
    </div>

     <script>
        var x = document.getElementById("login")
        var y = document.getElementById("register")
        var z = document.getElementById("btn")

        function register(){
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "110px";
        }
        function login(){
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
        }
        
    </script> 

</body> 
</html>       
