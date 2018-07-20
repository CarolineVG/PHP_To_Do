<?php
 // source: http://php.net/manual/en/features.file-upload.php 

?>

<!DOCTYPE html>
<html>
<body>

<form action="../uploads/upload.php" method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <button type="submit" name="submit" >upload image</button>

</form> 

</body>
</html>