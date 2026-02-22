<?php
require_once __DIR__ . "/_auth.php";
$id = (int)($_GET['id'] ?? 0);
if ($id) {
    mysqli_query($conn, "DELETE FROM donors WHERE donor_id = $id");
}
header('Location: donors.php?msg=Deleted');
exit;
?>
