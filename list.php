<a href="index.php?cmd=download">Download Zip</a>
<table width="100%" align="center">
	<tr>
		<td>subject</td>
		<td>file_picture</td>
	</tr>

<?php
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

for ($i = 0; $i < count($arr); $i ++) {
    ?>
    <tr>
		<td>
		  <?=$arr[$i]['subject']?>
        </td>
		<td><img src="<?=$arr[$i]['file_picture']?>"
			style="width: 100px; height: 100px;"></td>
	</tr>
<?php
}
?>  
</table>

