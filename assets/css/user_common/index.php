<?php
session_start();

if (!($_SESSION['user_status'] === "Active")) {
  
    header("Location:../../../index.php");
}else{
    header("Location:../../../errors/error_page.php");
    
}
?>
<html>
<head>
	<title>403 Forbidden</title>
</head>
<body>

<p>Directory access is forbidden.</p>

</body>
</html>
