<?php include("config/db.php"); 
$trip_id = $_GET['trip_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Settlement</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <h2>Settlement Calculation</h2>
  <?php
  $total_expenses = $conn->query("SELECT SUM(amount) AS total FROM expenses WHERE trip_id=$trip_id")->fetch_assoc()['total'] ?? 0;
  $total_members = $conn->query("SELECT COUNT(*) AS total FROM members WHERE trip_id=$trip_id")->fetch_assoc()['total'];

  $share = $total_members > 0 ? $total_expenses / $total_members : 0;

  echo "<div class='alert alert-info'>Total Expenses: ₹" . number_format($total_expenses,2) . "</div>";
  echo "<div class='alert alert-info'>Equal Share per Member: ₹" . number_format($share,2) . "</div>";

  $sql = "SELECT m.name, SUM(e.amount) AS paid 
          FROM members m 
          LEFT JOIN expenses e ON m.member_id = e.paid_by AND e.trip_id=$trip_id
          WHERE m.trip_id=$trip_id
          GROUP BY m.member_id";
  $result = $conn->query($sql);

  echo "<table class='table table-bordered mt-3'>
          <thead class='table-dark'>
            <tr>
              <th>Member</th>
              <th>Paid</th>
              <th>Balance</th>
            </tr>
          </thead>
          <tbody>";
  while ($row = $result->fetch_assoc()) {
      $paid = $row['paid'] ?? 0;
      $balance = $paid - $share;
      $status = $balance >= 0 
          ? "<span class='badge bg-success'>Gets back ₹" . number_format($balance,2) . "</span>" 
          : "<span class='badge bg-danger'>Owes ₹" . number_format(abs($balance),2) . "</span>";
      echo "<tr>
              <td>{$row['name']}</td>
              <td>₹" . number_format($paid,2) . "</td>
              <td>{$status}</td>
            </tr>";
  }
  echo "</tbody></table>";
  ?>
</div>
</body>
</html>
