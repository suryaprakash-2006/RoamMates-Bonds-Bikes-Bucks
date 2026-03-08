<?php include("config/db.php"); 
$trip_id = $_GET['trip_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Expense</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <h2>Add Expense</h2>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $desc = $_POST['description'];
      $amount = $_POST['amount'];
      $paid_by = $_POST['paid_by'];
      $date = $_POST['expense_date'];

      $stmt = $conn->prepare("INSERT INTO expenses (description, amount, paid_by, expense_date, trip_id) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("sdssi", $desc, $amount, $paid_by, $date, $trip_id);

      if ($stmt->execute()) {
          echo "<div class='alert alert-success'>Expense added successfully!</div>";
      } else {
          echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
      }
  }
  ?>
  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label>Description</label>
      <input type="text" name="description" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Amount</label>
      <input type="number" step="0.01" name="amount" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Paid By</label>
      <select name="paid_by" class="form-control" required>
        <?php
        $result = $conn->query("SELECT * FROM members WHERE trip_id=$trip_id");
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['member_id']}'>{$row['name']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Date</label>
      <input type="date" name="expense_date" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Expense</button>
  </form>
</div>
</body>
</html>
