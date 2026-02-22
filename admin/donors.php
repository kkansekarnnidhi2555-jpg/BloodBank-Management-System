<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

// Search
$search = "";
if (isset($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
}

$query = "SELECT * FROM donors WHERE 
          name LIKE '%$search%' 
          OR blood_group LIKE '%$search%' 
          ORDER BY donor_id DESC";

$result = mysqli_query($conn, $query);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Donors</title>
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

/* Page Layout */
.container {
    width: 90%;
    margin: 25px auto;
}

.header-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-add {
    background: #c70000;
    color: white;
    padding: 10px 18px;
    text-decoration: none;
    border-radius: 8px;
    font-weight: bold;
}

.btn-add:hover {
    background: #a00000;
}

/* Search Bar */
.search-bar input {
    width: 250px;
    padding: 10px;
    border: 1.5px solid #bbb;
    border-radius: 6px;
}

/* Donor Table */
.table-box {
    margin-top: 20px;
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 10px #ddd;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th {
    background: #c70000;
    color: white;
    padding: 12px;
    text-align: left;
}

table td {
    padding: 12px;
    border-bottom: 1px solid #eee;
}

.action-btns a {
    padding: 6px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
    margin-right: 8px;
}

.edit-btn {
    background: #ffd580;
    color: #663c00;
}

.delete-btn {
    background: #ffb3b3;
    color: #8a0000;
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

<!-- Donor Page Content -->
<div class="container">
    <div class="header-row">
        <h2>Donor List</h2>

        <a href="add_donor.php" class="btn-add">+ Add Donor</a>
    </div>

    <!-- Search Bar -->
    <form method="GET" class="search-bar">
        <input type="text" name="search" value="<?= $search ?>" placeholder="Search by name or blood group">
        <button class="btn">Search</button>
    </form>

    <!-- Donor Table -->
    <div class="table-box">
        <table>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Blood Group</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= (int)$row['age']; ?></td>
                <td><?= $row['blood_group']; ?></td>
                <td><?= $row['phone']; ?></td>
                <td class="action-btns">
                    <a href="edit_donor.php?id=<?= $row['donor_id']; ?>" class="edit-btn">Edit</a>
                    <a href="delete_donor.php?id=<?= $row['donor_id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>
</div>

</body>
</html>
