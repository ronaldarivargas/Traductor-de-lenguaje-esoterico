<?php
session_start();
session_unset();
session_destroy();
header('Location: server/user_adm/login.php');
exit;
?>