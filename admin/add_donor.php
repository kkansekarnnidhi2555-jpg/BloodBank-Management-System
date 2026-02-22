<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = $_POST["name"];
    $age    = $_POST["age"];
    $email  = $_POST["email"];
    $phone  = $_POST["phone"];
    $address = $_POST["address"];
    $blood  = $_POST["blood_group"];
    $medical = $_POST["medical_history"];
    $last_donation = $_POST["last_donation_date"];

    $query = "INSERT INTO donors (name, age, email, phone, address, blood_group, medical_history, last_donation_date)
              VALUES ('$name','$age','$email','$phone','$address','$blood','$medical','$last_donation')";

    mysqli_query($conn, $query);

    header("Location: donors.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Donor</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
/* Top Navigation */
.topnav {
    display: flex;
    background: white;
    padding: 15px 40px;
    border-bottom: 3px solid #c70000;
    align-items: center;
    justify-content: space-between;
}

.topnav .title {
    font-size: 28px;
    font-weight: bold;
    color: #222;
}

.nav-links a {
    margin-right: 20px;
    padding: 10px 18px;
    text-decoration: none;
    color: #222;
    font-weight: bold;
    border-radius: 6px;
}

.nav-links a.active {
    background: #c70000;
    color: white !important;
}

.nav-links a:hover {
    background: #ffe5e5;
}

/* Form Layout */
.form-container {
    width: 60%;
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

.input-group {
    margin-bottom: 18px;
}

.input-group label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
    color: #222;
}

.input-group input,
.input-group textarea,
.input-group select {
    width: 100%;
    padding: 12px;
    border-radius: 8px;
    border: 1.5px solid #ccc;
    font-size: 16px;
}

.btn-submit {
    background: #c70000;
    color: white;
    padding: 12px 25px;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
}

.btn-submit:hover {
    background: #a00000;
}
</style>
</head>

<body>

<!-- Top Navigation -->
<div class="topnav">
    <div class="title">Blood Bank Management System</div>

    <div class="nav-links">
        <a href="dashboard.php">📊 Dashboard</a>
        <a href="inventory.php">🩸 Inventory</a>
        <a href="donors.php" class="active">👥 Donors</a>
        <a href="requests.php">🏥 Requests</a>
    </div>

    <a href="logout.php" class="btn">Logout</a>
</div>

<!-- Add Donor Form -->
<div class="form-container">
    <h2>Add New Donor</h2>

    <form method="POST">

        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="input-group">
            <label>Age</label>
            <input type="number" name="age" required>
        </div>

        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email">
        </div>

        <div class="input-group">
            <label>Phone</label>
            <input type="text" name="phone" required>
        </div>

        <div class="input-group">
            <label>Address</label>
            <textarea name="address" rows="3"></textarea>
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
            <label>Medical History</label>
            <textarea name="medical_history" rows="3"></textarea>
        </div>

        <div class="input-group">
            <label>Last Donation Date</label>
            <input type="date" name="last_donation_date">
        </div>

        <button class="btn-submit">Add Donor</button>

    </form>
</div>

</body>
</html>
