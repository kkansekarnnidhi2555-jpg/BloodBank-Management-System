<?php
require_once __DIR__ . "/_auth.php";
$id = (int)($_GET['id'] ?? 0);
if (!$id) header('Location: donors.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $age = (int)$_POST['age'];
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $address = mysqli_real_escape_string($conn,$_POST['address']);
    $med = mysqli_real_escape_string($conn,$_POST['medical_history']);
    $bg = mysqli_real_escape_string($conn,$_POST['blood_group']);
    $ld = $_POST['last_donation_date']?:NULL;

    $q = "UPDATE donors SET name='$name', age=$age, email='$email', phone='$phone', address='$address',
          medical_history='$med', blood_group='$bg', last_donation_date=" . ($ld? "'{$ld}'":"NULL") . " WHERE donor_id=$id";
    mysqli_query($conn,$q);
    header('Location: donors.php?msg=Updated');
    exit;
}

$res = mysqli_query($conn, "SELECT * FROM donors WHERE donor_id=$id");
$row = mysqli_fetch_assoc($res);
?>
<!doctype html><html><head><meta charset="utf-8"><title>Edit Donor</title><link rel="stylesheet" href="../assets/style.css"></head><body>
<div class="header"><div class="container header-row"><div class="brand">Edit Donor</div><div><a class="btn" href="donors.php">Back</a></div></div></div>
<div class="container">
  <div class="card">
    <form method="post">
      <label>Name</label><input name="name" required value="<?=htmlspecialchars($row['name'])?>">
      <label>Age</label><input name="age" type="number" required value="<?=htmlspecialchars($row['age'])?>">
      <label>Email</label><input name="email" type="email" value="<?=htmlspecialchars($row['email'])?>">
      <label>Phone</label><input name="phone" value="<?=htmlspecialchars($row['phone'])?>">
      <label>Address</label><input name="address" value="<?=htmlspecialchars($row['address'])?>">
      <label>Medical History</label><textarea name="medical_history"><?=htmlspecialchars($row['medical_history'])?></textarea>
      <label>Blood Group</label><input name="blood_group" required value="<?=htmlspecialchars($row['blood_group'])?>">
      <label>Last Donation Date</label><input name="last_donation_date" type="date" value="<?=htmlspecialchars($row['last_donation_date'])?>">
      <button class="btn">Update Donor</button>
    </form>
  </div>
</div></body></html>
