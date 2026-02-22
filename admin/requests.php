<?php
require_once __DIR__ . "/_auth.php";
require_once "../db/connection.php";

$requests = mysqli_query($conn, "SELECT * FROM hospital_requests ORDER BY hospital_id DESC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Hospital Requests</title>

<link rel="stylesheet" href="../assets/style.css">

<style>
/* PAGE LAYOUT */
.page-wrapper {
    width: 90%;
    margin: 40px auto;
}

/* HEADER BAR */
.requests-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.requests-header h2 {
    color: #b30000;
    margin: 0;
}

.btn-add {
    background: #c70000;
    color: white;
    padding: 10px 18px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
}
.btn-add:hover { background: #a00000; }

/* TABLE CARD */
.table-card {
    background: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 10px #ddd;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
}

th {
    background: #c70000;
    color: white;
    padding: 14px;
    text-align: left;
    font-size: 16px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #eee;
    font-size: 15px;
}

/* STATUS COLORS */
.status {
    padding: 6px 12px;
    border-radius: 6px;
    font-weight: bold;
    color: white;
}
.pending { background: #ff9800; }
.approved { background: #28a745; }
.rejected { background: #dc3545; }

/* ACTION BUTTONS */
.btn-small {
    padding: 7px 12px;
    border-radius: 6px;
    text-decoration: none;
    font-weight: bold;
    color: white;
    margin-right: 4px;
    font-size: 14px;
}

.approve-btn { background: #28a745; }
.reject-btn  { background: #dc3545; }
.delete-btn  { background: #555; }

.btn-small:hover { opacity: 0.85; }
</style>

</head>

<body>

<?php include "_topnav.php"; ?>

<div class="page-wrapper">

    <div class="requests-header">
        <h2>Hospital Blood Requests</h2>
        <a href="add_request.php" class="btn-add">+ Add Request</a>
    </div>

    <div class="table-card">
        <table>
            <tr>
                <th>Hospital</th>
                <th>Blood Group</th>
                <th>Quantity</th>
                <th>Request Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php while ($r = mysqli_fetch_assoc($requests)) { ?>
            <tr>
                <td><?= htmlspecialchars($r['hospital_name']); ?></td>
                <td><?= $r['blood_group']; ?></td>
                <td><?= $r['quantity_ml']; ?> ml</td>
                <td><?= $r['request_date']; ?></td>

                <td>
                    <?php if($r['status']=='Pending'): ?>
                        <span class="status pending">Pending</span>
                    <?php elseif($r['status']=='Approved'): ?>
                        <span class="status approved">Approved</span>
                    <?php else: ?>
                        <span class="status rejected">Rejected</span>
                    <?php endif; ?>
                </td>

                <td>
                    <a href="request_action.php?id=<?= $r['hospital_id']; ?>&action=approve" class="btn-small approve-btn">Approve</a>
                    <a href="request_action.php?id=<?= $r['hospital_id']; ?>&action=reject" class="btn-small reject-btn">Reject</a>
                    <a href="request_action.php?id=<?= $r['hospital_id']; ?>&action=delete" class="btn-small delete-btn">Delete</a>
                </td>
            </tr>
            <?php } ?>

        </table>
    </div>

</div>

</body>
</html>
