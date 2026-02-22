<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hospital = $_POST["hospital_name"];
    $blood_group = $_POST["blood_group"];
    $qty = $_POST["quantity_ml"];
    $date = $_POST["request_date"];

    mysqli_query($conn, "
        INSERT INTO hospital_requests (hospital_name, blood_group, quantity_ml, request_date, status)
        VALUES ('$hospital', '$blood_group', '$qty', '$date', 'Pending')
    ");

    header("Location: requests.php");
    exit;
}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Hospital Request</title>
<link rel="stylesheet" href="../assets/style.css">
<style>
.form-container {
    width: 55%;
    margin: 40px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px #ddd;
}
.input-group { margin-bottom: 18px; }
.input-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
}
.input-group input,
.input-group select {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1.5px solid #bbb;
}
.btn-submit {
    background: #c70000;
    color: white;
    padding: 12px 22px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
}
.btn-submit:hover { background: #a00000; }
</style>
</head>

<body>

<?php include "_topnav.php"; ?>

<div class="form-container">
    <h2 style="color:#c70000; text-align:center;">Add Hospital Request</h2>

    <form method="POST">

        <div class="input-group">
            <label>Hospital Name</label>
            <input type="text" name="hospital_name" required>
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
            <label>Request Date</label>
            <input type="date" name="request_date" required>
        </div>

        <button class="btn-submit">Save Request</button>

    </form>
</div>

</body>
</html>
