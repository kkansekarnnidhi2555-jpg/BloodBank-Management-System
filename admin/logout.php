<?php
require_once __DIR__ . "/../db/connection.php";
session_destroy();
header('Location: login.php');
exit;
?>
