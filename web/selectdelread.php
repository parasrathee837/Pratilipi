 <?php
 require_once 'config.php'; 
  $sqlSelectmax = "SELECT max(Count) as maxcount FROM tbl_read_count where StoryId='".$_GET['id']."'";
   $resultmax = mysqli_query($conn,$sqlSelectmax) or die ('Error: ' .mysqli_error());
   $total_rowsmax=mysqli_num_rows($resultmax);
   if($total_rowsmax>0)
   {
						if($rowmax = mysqli_fetch_array($resultmax))
						{  
							echo $maxcountread=$rowmax['maxcount'];
						}
   }
	  ?>