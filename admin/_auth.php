<?php
// admin/_auth.php
require_once __DIR__ . "/../db/connection.php";
if (empty($_SESSION['admin_logged'])) {
    header('Location: login.php');
    exit;
}
?>
