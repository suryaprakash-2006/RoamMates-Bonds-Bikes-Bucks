<?php include("config/db.php"); 
$trip_id = $_GET['trip_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Trip Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <?php
  $trip = $conn->query("SELECT * FROM trips WHERE trip_id=$trip_id")->fetch_assoc();
  ?>
  <h2 class="mb-4 text-center"><?php echo $trip['trip_name']; ?> Dashboard</h2>

  <div class="row g-4">
    <!-- Members -->
    <div class="col-md-6">
      <div class="card text-center shadow-sm h-100">
        <div class="card-body">
          <h5>Members</h5>
          <?php
          $members = $conn->query("SELECT COUNT(*) AS total FROM members WHERE trip_id=$trip_id")->fetch_assoc()['total'];
          ?>
          <p class="display-6"><?php echo $members; ?></p>
          <a href="add_member.php?trip_id=<?php echo $trip_id; ?>" class="btn btn-outline-primary btn-sm">Add Member</a>
        </div>
      </div>
    </div>

    <!-- Expenses -->
    <div class="col-md-6">
      <div class="card text-center shadow-sm h-100">
        <div class="card-body">
          <h5>Expenses</h5>
          <?php
          $expenses = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE trip_id=$trip_id")->fetch_assoc()['total'] ?? 0;
          ?>
          <p class="display-6">₹<?php echo number_format($expenses,2); ?></p>
          <a href="add_expense.php?trip_id=<?php echo $trip_id; ?>" class="btn btn-outline-success btn-sm">Add Expense</a>
        </div>
      </div>
    </div>
  </div>

  <div class="mt-5 text-center">
    <a href="view_expenses.php?trip_id=<?php echo $trip_id; ?>" class="btn btn-info me-2">View Expenses</a>
    <a href="settlement.php?trip_id=<?php echo $trip_id; ?>" class="btn btn-dark">Settlement</a>
  </div>
</div>
</body>
</html>
