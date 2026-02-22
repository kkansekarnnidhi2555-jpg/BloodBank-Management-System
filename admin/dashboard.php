<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

// Fetch Counts
$donors = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM donors"))['c'];
$donations = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM blood_donations"))['c'];
$requests = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM hospital_requests"))['c'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>
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

/* Dashboard Cards */
.dashboard-container {
    width: 90%;
    margin: 30px auto;
}

.cards {
    display: flex;
    gap: 25px;
    margin-top: 20px;
}

.card-box {
    background: white;
    padding: 25px;
    width: 300px;
    border-radius: 12px;
    box-shadow: 0 0 10px #ddd;
    border: 1px solid #eee;
    text-align: center;
}

.card-box h3 {
    color: #c70000;
    margin-bottom: 10px;
    font-size: 22px;
}

.card-box p {
    font-size: 30px;
    font-weight: bold;
    margin: 0;
}

.icon {
    font-size: 40px;
    margin-bottom: 10px;
    color: #c70000;
}
</style>

</head>
<body>

<!-- Top Navigation -->
<div class="topnav">
    <div class="title">Blood Bank Management System</div>

    <div class="nav-links">
        <a href="dashboard.php" class="active">📊 Dashboard</a>
        <a href="inventory.php">🩸 Inventory</a>
        <a href="donors.php">👥 Donors</a>
        <a href="requests.php">🏥 Requests</a>
    </div>

    <a href="logout.php" class="btn">Logout</a>
</div>

<!-- Dashboard Content -->
<div class="dashboard-container">

    <h2>Overview</h2>

    <div class="cards">

        <div class="card-box">
            <div class="icon">👥</div>
            <h3>Total Donors</h3>
            <p><?= $donors ?></p>
        </div>

        <div class="card-box">
            <div class="icon">🩸</div>
            <h3>Total Donations</h3>
            <p><?= $donations ?></p>
        </div>

        <div class="card-box">
            <div class="icon">🏥</div>
            <h3>Hospital Requests</h3>
            <p><?= $requests ?></p>
        </div>

    </div>
</div>

</body>
</html>
