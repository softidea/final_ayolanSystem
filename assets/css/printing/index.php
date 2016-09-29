<?php
session_start();

if (!($_SESSION['user_status'] === "Active")) {
    if (isset($_SESSION['user_typel'])) {
        
        if ($_SESSION['user_typel'] === "Admin") {
            
        }
        
    }
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
