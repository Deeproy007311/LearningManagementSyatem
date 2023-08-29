<?php
session_start();
session_unset();
session_destroy();
header("Location: /learningmanagementsystem/admin/index.php");
exit();
?>