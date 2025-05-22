<?php
session_start();
session_unset();
session_destroy();
header('Location: /Traductor-de-lenguaje-esoterico/index.php');
exit;
?>