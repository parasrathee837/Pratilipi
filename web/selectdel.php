<?php
require_once 'config.php'; 
   $sqlSelectmaxcu = "SELECT  COUNT(*)  as count FROM tbl_currentview where StoryId='".$_GET['id']."'";
   $resultmaxcu = mysqli_query($conn,$sqlSelectmaxcu) or die ('Error: ' .mysqli_error());
   $total_rowsmaxcu=mysqli_num_rows($resultmaxcu);
   if($total_rowsmaxcu>0)
   {
						if($rowmaxcu = mysqli_fetch_array($resultmaxcu))
						{  
							echo $maxcountreadcu=$rowmaxcu['count'];
						}
   }
	  ?>