<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

// Fetch donor list for dropdown
$donors = mysqli_query($conn, "SELECT donor_id, name, blood_group FROM donors ORDER BY name");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $donor_id = $_POST["donor_id"];
    $blood_group = $_POST["blood_group"];
    $qty = $_POST["quantity_ml"];
    $date = $_POST["donation_date"];

    mysqli_query($conn, 
        "INSERT INTO blood_donations (donor_id, blood_group, quantity_ml, donation_date)
         VALUES ('$donor_id', '$blood_group', '$qty', '$date')"
    );

    // auto-update inventory
    mysqli_query($conn, 
        "UPDATE blood_inventory 
         SET quantity_ml = quantity_ml + $qty 
         WHERE blood_group = '$blood_group'"
    );

    header("Location: donations.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Record Donation</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
<?php echo file_get_contents("../assets/style.css"); ?>
.form-container {
    width: 55%;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px #ddd;
}
.form-container h2 {
    color: #c70000;
    text-align: center;
    margin-bottom: 20px;
}
.input-group { margin-bottom: 18px; }
.input-group label { display:block; font-weight:bold; margin-bottom:6px; }
.input-group input, .input-group select {
    width:100%; padding:12px; border-radius:8px; border:1.5px solid #bbb;
}
.btn-submit {
    background:#c70000; color:white; padding:12px 22px;
    border:none; border-radius:8px; font-size:18px; cursor:pointer;
}
.btn-submit:hover { background:#a00000; }
</style>
</head>

<body>

<!-- NAVBAR -->
<?php include "_topnav.php"; ?>

<div class="form-container">
    <h2>Record a Donation</h2>

    <form method="POST">

        <div class="input-group">
            <label>Select Donor</label>
            <select name="donor_id" required>
                <option value="" disabled selected>Select Donor</option>
                <?php while($d = mysqli_fetch_assoc($donors)) { ?>
                    <option value="<?= $d['donor_id']; ?>">
                        <?= $d['name'] ?> (<?= $d['blood_group'] ?>)
                    </option>
                <?php } ?>
            </select>
        </div>

        <div class="input-group">
            <label>Blood Group</label>
            <select name="blood_group" required>
                <option value="" disabled selected>Select Blood Group</option>
                <option>A+</option><option>A-</option>
                <option>B+</option><option>B-</option>
                <option>O+</option><option>O-</option>
                <option>AB+</option><option>AB-</option>
            </select>
        </div>

        <div class="input-group">
            <label>Quantity (ml)</label>
            <input type="number" name="quantity_ml" required>
        </div>

        <div class="input-group">
            <label>Donation Date</label>
            <input type="date" name="donation_date" required>
        </div>

        <button class="btn-submit">Save Donation</button>

    </form>
</div>

</body>
</html>
