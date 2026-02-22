<?php
require_once __DIR__ . "/_auth.php";
$id = (int)($_GET['id'] ?? 0);
if (!$id) header('Location: requests.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = mysqli_real_escape_string($conn,$_POST['status']);
    $fulfilled = $_POST['fulfilled_date']?:NULL;
    mysqli_query($conn, "UPDATE hospital_requests SET status='$status', fulfilled_date=" . ($fulfilled? "'{$fulfilled}'":"NULL") . " WHERE hospital_id=$id");

    // if fulfilled -> deduct inventory
    if ($status === 'Fulfilled') {
        $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT blood_group,quantity_ml FROM hospital_requests WHERE hospital_id=$id"));
        if ($row) {
            $bg = $row['blood_group'];
            $q = (int)$row['quantity_ml'];
            mysqli_query($conn, "UPDATE blood_inventory SET quantity_ml = GREATEST(0, quantity_ml - $q) WHERE blood_group='$bg'");
        }
    }

    header('Location: requests.php');
    exit;
}

$row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM hospital_requests WHERE hospital_id=$id"));
?>
<!doctype html><html><head><meta charset="utf-8"><title>Update Request</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<div class="header"><div class="container header-row"><div class="brand">Update Request</div><div><a class="btn" href="requests.php">Back</a></div></div></div>
<div class="container">
  <div class="card">
    <form method="post">
      <p><b>Hospital:</b> <?=htmlspecialchars($row['hospital_name'])?></p>
      <p><b>Blood:</b> <?=htmlspecialchars($row['blood_group'])?> (<?= (int)$row['quantity_ml'] ?> ml)</p>
      <label>Status</label>
      <select name="status">
        <option <?= $row['status']==='Pending' ? 'selected':'' ?>>Pending</option>
        <option <?= $row['status']==='Approved' ? 'selected':'' ?>>Approved</option>
        <option <?= $row['status']==='Fulfilled' ? 'selected':'' ?>>Fulfilled</option>
        <option <?= $row['status']==='Rejected' ? 'selected':'' ?>>Rejected</option>
      </select>
      <label>Fulfilled Date</label>
      <input type="date" name="fulfilled_date" value="<?=htmlspecialchars($row['fulfilled_date'])?>">
      <button class="btn">Update</button>
    </form>
  </div>
</div></body></html>
