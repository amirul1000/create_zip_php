<?php
include ("connection.php");
session_start();

$cmd = $_REQUEST['cmd'];
switch ($cmd) {
    case "upload":
        if (strlen($_FILES['file_picture']['name']) > 0 && $_FILES['file_picture']['size'] > 0) {
              $destionation  = "images/".$_FILES['file_picture']['name'];
			 $status =  move_uploaded_file($_FILES['file_picture']['tmp_name'],$destionation);
			 if($status==FALSE)
			 {
				 echo "Fail";
				 exit;
			 }
        }
		$sql = "INSERT into files (subject,file_picture) VALUES('".$_REQUEST['subject']."','".$destionation."')";
		$result = $conn->query($sql);
		if($result)
		{
			$message = "Data has been saved";
		}
		else
		{
			$message = "Error Occured";
		}
		include ("form.php"); 
        break;
    case "download":
        $sql = "SELECT * from files";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $arr = array();
            $i = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                while (list ($key, $value) = each($data))
                    $arr[$i][$key] = $value;
                $i ++;
            }
        }
		
		for($i=0;$i<count($arr);$i++)
		{
			$files[] = $arr[$i]['file_picture'];
		}
		
		
		$zipname = 'zip/archive_.zip';
		
		$zip = new ZipArchive;
		$zip->open($zipname, ZipArchive::CREATE);
		foreach ($files as $file) {
		  $zip->addFile($file);
		}
		$zip->close();
		
		///Then download the zipped file.
		header('Content-Type: application/zip');
		header('Content-disposition: attachment; filename='.$zipname);
		header('Content-Length: ' . filesize($zipname));
		readfile($zipname);
        exit();
        break;
    default:
        include ("form.php");
}
?>