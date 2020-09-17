<?php 
ob_start();
session_start();
if ($_SESSION['ADMINID']==null)
{
	header('location:index.php');
}
require_once 'config.php'; 
$sqlQDelete="Delete from tbl_currentview where UserId='".$_SESSION['ADMINID']."'";
mysqli_query($conn, $sqlQDelete);
?>
<html>
<head>
 <script src="js/jquery.min.js"></script>
 <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="css/login.css" rel="stylesheet">
</head>
<body>
<header style="background-color: red !important;">
<!--Main Navigation-->
<div class="header-section">
    <div class="header-section-1" style="padding-left:10px;">
        <div class="site-logo">
            <a class="navbar-brand" style="color: #fff!important;" href="story.php">STORY CONTENT APPLICATION</a>
        </div>
    </div>

    <div class="header-section-2">
      &nbsp;
    </div>

    <div class="header-section-3" style="color:#fff;text-align:right;padding:5px 10px 5px 10px;">
        Welcome <?php echo $_SESSION['USER'] ?> | <a href="logout.php" style="color:#fff;text-decoration:none;">LOG OUT</a>
    </div>
</div>

  </header>
<!--Main Navigation-->

<!--Main Layout-->
<main>
    <div class="container" style="margin-top:28px;">
  <div class="row">
  <?php
  $sqlSelect = "SELECT  Id,Title,Image FROM tbl_story order by Id DESC";
   $result = mysqli_query($conn,$sqlSelect) or die ('Error: ' .mysqli_error());
   $total_rows=mysqli_num_rows($result);
   if($total_rows>0)
   {
						while($row = mysqli_fetch_array($result))
						{  
  ?>
    <div class="col-sm">
	 <a href="story_content.php?id=<?php echo $row['Id']; ?>"><img src="images/<?php echo $row['Image'];  ?>" class="img-rounded" alt="Cinque Terre" width="304" height="236"> </a>
	<p><b> 
	<a href="story_content.php?id=<?php echo $row['Id']; ?>" style="text-decoration:none;font-size:18px;"><?php echo $row['Title']; ?></a></b></p></div>
  <?php } } else { echo '<font color="red"><center>No Records Found</center></font>';} ?>
   
  </div>
</div>
</main>
<footer>
<div class="footer">
  <p>Copyright &copy; 2020 All Rights Reserved.</p>
</div>

</footer>
</body>
</html>