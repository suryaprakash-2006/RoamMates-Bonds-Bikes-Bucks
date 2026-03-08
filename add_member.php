<?php include("config/db.php"); 
$trip_id = $_GET['trip_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Member</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <h2>Add Member</h2>
  <?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $name = $_POST['name'];
      $email = $_POST['email'];

      $stmt = $conn->prepare("INSERT INTO members (name, email, trip_id) VALUES (?, ?, ?)");
      $stmt->bind_param("ssi", $name, $email, $trip_id);

      if ($stmt->execute()) {
          echo "<div class='alert alert-success'>Member added successfully!</div>";
      } else {
          echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
      }
  }
  ?>
  <form method="POST" class="card p-4 shadow-sm">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Member</button>
  </form>
</div>
</body>
</html>
