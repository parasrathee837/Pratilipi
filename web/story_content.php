<?php 
ob_start();
session_start();
if ($_SESSION['ADMINID']==null)
{
	header('location:index.php');
}
require_once 'config.php'; 
if(!isset($_GET['id']))
{
	header('location:story.php');
}

/* current view*/
      	    $sqlQryrecu = "SELECT * from tbl_currentview WHERE StoryId='".$_GET['id']."' and UserId='".$_SESSION['ADMINID']."'";	
			$resultrecu =mysqli_query($conn,$sqlQryrecu) or die('Error: ' . mysqli_error());
			$numRowsrecu = mysqli_num_rows($resultrecu);
			if ($numRowsrecu == 0)
			{
				$countcr=1;
				$sqlrecount = "INSERT INTO tbl_currentview(Count,UserId,StoryId)VALUES ('".$countcr."','".$_SESSION['ADMINID']."','".$_GET['id']."')";
				mysqli_query($conn, $sqlrecount);
			}
			
/* end */
			$sqlQryre = "SELECT * from tbl_read_count WHERE StoryId='".$_GET['id']."' and UserId='".$_SESSION['ADMINID']."'";	
			$resultre =mysqli_query($conn,$sqlQryre) or die('Error: ' . mysqli_error());
			$numRowsre = mysqli_num_rows($resultre);
			if ($numRowsre == 0)
			{
				  $sqlQryexst = "SELECT Id,Count from tbl_read_count WHERE StoryId='".$_GET['id']."'";	
			      $resultexst =mysqli_query($conn,$sqlQryexst) or die('Error: ' . mysqli_error());
			     $numRowsexst = mysqli_num_rows($resultexst);
                   if($numRowsexst == 0)
				{
					    $count=1;
				}
				else
				
				{
					 if($rowrest = mysqli_fetch_array($resultexst))
						{ 
								 $count=$rowrest['Count']+1;
						}
				}
                  $sqlre = "INSERT INTO tbl_read_count(UserId,Count,StoryId)VALUES ('".$_SESSION['ADMINID']."','".$count."','".$_GET['id']."')";
				  mysqli_query($conn, $sqlre);
				  $sqlUde="Update tbl_read_count set Count='".$count."' where StoryId='".$_GET['id']."'";
				  mysqli_query($conn, $sqlUde);
			}
			else
			{
                   $sqlQryex = "SELECT * from tbl_read_count WHERE StoryId='".$_GET['id']."' and UserId='".$_SESSION['ADMINID']."'";	
			      $resultex =mysqli_query($conn,$sqlQryex) or die('Error: ' . mysqli_error());
			      $numRowsex = mysqli_num_rows($resultex);
                   if($numRowsex>0)
			    	{
					    
				    }
				   else
				   {
						if($rowre = mysqli_fetch_array($resultre))
						{ 
								$countre=$rowre['Count'];
						}

						$countupd=$countre+1;
						$sqlupd="Update tbl_read_count set Count='".$countupd."' where StoryId='".$_GET['id']."'";
						mysqli_query($conn, $sqlupd);
				   }
					
			}
?>
<html>
<head>
<meta http-equiv="refresh" content="3600">
 <script src="js/jquery.min.js"></script>
 <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link href="css/login.css" rel="stylesheet">
	  <style type="text/css">
    .currently-active {
      position: fixed;
      margin: 10px;
      padding: 5px;
      bottom: 0;
      left: 0;
      border: solid 1px #AFAFAF;
      border-radius: 6px;
      font-family: "Arial";
    }
  </style>
  <script>
  $(document).ready(function()
{
	setInterval(function(){
      $('#timeval').load('selectdel.php?id='+$('#txtHidden').val());
	   $('#timevalreco').load('selectdelread.php?id='+$('#txtHidden').val());
    },2000);  
});
	</script>
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

<?php
   $sqlSelectmaxcu = "SELECT  COUNT(*)  as count FROM tbl_currentview where StoryId='".$_GET['id']."'";
   $resultmaxcu = mysqli_query($conn,$sqlSelectmaxcu) or die ('Error: ' .mysqli_error());
   $total_rowsmaxcu=mysqli_num_rows($resultmaxcu);
   if($total_rowsmaxcu>0)
   {
						if($rowmaxcu = mysqli_fetch_array($resultmaxcu))
						{  
							$maxcountreadcu=$rowmaxcu['count'];
						}
   }
	  ?>
	  <?php
   $sqlSelectmax = "SELECT max(Count) as maxcount FROM tbl_read_count where StoryId='".$_GET['id']."'";
   $resultmax = mysqli_query($conn,$sqlSelectmax) or die ('Error: ' .mysqli_error());
   $total_rowsmax=mysqli_num_rows($resultmax);
   if($total_rowsmax>0)
   {
						if($rowmax = mysqli_fetch_array($resultmax))
						{  
							$maxcountread=$rowmax['maxcount'];
						}
   }
	  ?>
	 
  <?php
  $sqlSelect = "SELECT * FROM tbl_story where Id='".$_GET['id']."'";
   $result = mysqli_query($conn,$sqlSelect) or die ('Error: ' .mysqli_error());
   $total_rows=mysqli_num_rows($result);
   if($total_rows>0)
   {
						if($row = mysqli_fetch_array($result))
						{  
  ?>
  <div class="header-section" style="margin-top:15px;">
    <div class="header-section-1" style="padding-left:10px;">
        <div class="site-logo">
           
        </div>
    </div>
    <div class="header-section-2" style="font-size:30px;color:red;font-weight:bold;padding-bottom:2px;text-align:center;">
    <?php echo $row['Title'];  ?>
    </div>

    <div class="header-section-3" style="color:red;text-align:right;font-weight:bold;font-size:20px;padding:0px 15px 5px 10px;">
    Total read count: <span id="timevalreco"><?php echo $maxcountread; ?></span>
  <br/>Online Viewers: <span id="timeval"><?php echo $maxcountreadcu; ?></span>
    </div>
</div>

	 
    <div class="container" style="margin-top:10px;">
  <div class="">
  <div class="row" align='center'>
  <!--<div class="col-sm" style="font-size:30px;color:red;font-weight:bold;padding-bottom:2px;">  <?php echo $row['Title'];  ?>
  </div>-->
  <!--<div style="color:red;font-weight:bold;font-size:20px;float:left;padding-top:8px;" class="col-sm">
  Total read count: <?php echo $maxcountread; ?>
  <br/>Online Viewers: <?php echo $maxcountreadcu; ?>
</div>--></div>
    <div align="center">
	 <a href="story_content.php?id=<?php echo $row['Id']; ?>"><img src="images/<?php echo $row['Big_Image'];  ?>" style="height:400px;width:800px;" class="img-rounded" alt="Cinque Terre"> </a></div>
	 <div>
	 <p>
	 <?php echo $row['Content'];  ?></p> 
	</div>
	
	
<div style="clear:both;"></div>
</div> </div>

</div>
  <?php } } else { echo '<font color="red"><center>No Records Found</center></font>';} ?>
  <input type="text" name="txtHidden" id="txtHidden" value="<?php if(isset($_GET['id'])) { echo $_GET['id']; } ?>"> 
 
</main>
<footer>
<div class="footer">
  <p>Copyright &copy; 2020 All Rights Reserved.</p>
</div>

</footer>
</body>
</html>