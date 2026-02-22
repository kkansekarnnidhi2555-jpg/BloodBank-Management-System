<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";
$res = mysqli_query($conn, "SELECT * FROM blood_inventory ORDER BY blood_group");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Blood Inventory</title>
<link rel="stylesheet" href="../assets/style.css">

<style>
/* Top Navigation Bar */
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

/* Inventory Grid */
.inventory-container {
    width: 90%;
    margin: 20px auto;
}

.inventory-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 25px;
    margin-top: 20px;
}

.blood-card {
    background: white;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 0 10px #ddd;
    border: 1.5px solid #eee;
}

.blood-card img {
    width: 35px;
}

.blood-card .bg {
    font-size: 30px;
    font-weight: bold;
    color: #333;
    margin-top: 10px;
}

.blood-card .litre {
    font-size: 26px;
    color: #d10000;
    font-weight: bold;
    margin-top: 10px;
}

.blood-card .ml {
    color: #555;
    margin-bottom: 10px;
}

.tag {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 14px;
    margin-top: 10px;
}

.empty { background: #eee; color: #444; }
.normal { background: #d1ffd6; color: #006400; }
.critical { background: #ffd4d4; color: #a00000; }

/* Add Donation Button */
.top-right-btn {
    float: right;
    margin: 15px 40px;
}

.btn-add {
    background: #d10000;
    padding: 10px 20px;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}

.btn-add:hover {
    background: #a80000;
}

</style>
</head>

<body>

<!-- Top Navigation -->
<div class="topnav">
    <div class="title">Blood Bank Management System</div>

    <div class="nav-links">
        <a href="inventory.php" class="active">🩸 Blood Inventory</a>
        <a href="donors.php">👥 Donors</a>
        <a href="requests.php">🏥 Hospital Requests</a>
        <a href="dashboard.php">📊 Dashboard</a>
    </div>

    <a href="logout.php" class="btn">Logout</a>
</div>

<!-- Add Donation Button -->
<div class="top-right-btn">
    <a class="btn-add" href="add_donation.php">+ Record Donation</a>
</div>

<!-- Inventory Section -->
<div class="inventory-container">

    <h2>Blood Inventory</h2>

    <div class="inventory-grid">

        <?php while($r = mysqli_fetch_assoc($res)): 
            $ml = (int)$r['quantity_ml'];
            $litre = number_format($ml / 1000, 2);

            if ($ml == 0) { 
                $tag = "<span class='tag empty'>Empty</span>";
            } else if ($ml < 1000) { 
                $tag = "<span class='tag critical'>Critical</span>";
            } else {
                $tag = "<span class='tag normal'>Normal</span>";
            }
        ?>

        <div class="blood-card">
            <img src="../assets/blood.png" alt="blood">
            <div class="bg"><?= $r['blood_group'] ?></div>
            <div class="litre"><?= $litre ?>L</div>
            <div class="ml"><?= $ml ?> ml</div>
            <?= $tag ?>
        </div>

        <?php endwhile; ?>

    </div>
</div>

</body>
</html>
