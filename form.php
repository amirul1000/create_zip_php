<?php
  if(isset($message))
  {
	echo $message;  
  }
?>

<form action="index.php" method="post" enctype="multipart/form-data">
   <input type="text" name="subject"><br><br>
   <input type="file" name="file_picture"><br><br>
   <input type="hidden" name="cmd" value="upload">
   <input type="submit" value="submit">
</form>


<?php
 include("list.php");
?>
