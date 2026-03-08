<?php include("config/db.php"); 
$trip_id = $_GET['trip_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>View Expenses</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <h2>All Expenses</h2>
  <table class="table table-bordered table-striped mt-3">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Paid By</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT e.expense_id, e.description, e.amount, e.expense_date, m.name 
              FROM expenses e 
              JOIN members m ON e.paid_by = m.member_id 
              WHERE e.trip_id=$trip_id
              ORDER BY e.expense_date DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              echo "<tr>
                      <td>{$row['expense_id']}</td>
                      <td>{$row['description']}</td>
                      <td>₹" . number_format($row['amount'],2) . "</td>
                      <td>{$row['name']}</td>
                      <td>{$row['expense_date']}</td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='5' class='text-center'>No expenses found</td></tr>";
      }
      ?>
    </tbody>
  </table>
</div>
</body>
</html>
