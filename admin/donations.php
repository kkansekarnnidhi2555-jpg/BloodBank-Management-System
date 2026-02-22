<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

$result = mysqli_query($conn, "
    SELECT d.*, donors.name AS donor_name 
    FROM blood_donations d
    JOIN donors ON donors.donor_id = d.donor_id
    ORDER BY donation_id DESC
");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Donations</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
<?php echo file_get_contents("../assets/style.css"); ?>

.container { width:90%; margin:25px auto; }

.header-row {
    display:flex; justify-content:space-between; align-items:center;
}

.table-box {
    margin-top:20px;
    background:white; padding:20px;
    border-radius:12px; box-shadow:0 0 10px #ddd;
}

table { width:100%; border-collapse:collapse; }
table th {
    background:#c70000; color:white;
    padding:12px; text-align:left;
}
table td { padding:12px; border-bottom:1px solid #eee; }

.btn-add {
    background:#c70000; color:white; padding:10px 18px;
    border-radius:8px; text-decoration:none; font-weight:bold;
}
.btn-add:hover { background:#a00000; }
</style>
</head>

<body>

<!-- NAVBAR -->
<?php include "_topnav.php"; ?>

<div class="container">

    <div class="header-row">
        <h2>Donation Records</h2>

        <a href="add_donation.php" class="btn-add">+ Record Donation</a>
    </div>

    <div class="table-box">
        <table>
            <tr>
                <th>Donor</th>
                <th>Blood Group</th>
                <th>Quantity (ml)</th>
                <th>Date</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?= $row['donor_name']; ?></td>
                    <td><?= $row['blood_group']; ?></td>
                    <td><?= $row['quantity_ml']; ?></td>
                    <td><?= $row['donation_date']; ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>
