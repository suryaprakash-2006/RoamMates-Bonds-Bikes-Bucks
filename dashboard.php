<?php include("config/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard - RoamMates</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center">Trips</h2>
  <div class="row g-4">
    <?php
    $result = $conn->query("SELECT * FROM trips ORDER BY start_date DESC");
    if ($result->num_rows > 0) {
        while ($trip = $result->fetch_assoc()) {
            echo "
            <div class='col-md-4'>
              <div class='card shadow-sm h-100'>
                <div class='card-body text-center'>
                  <h5>{$trip['trip_name']}</h5>
                  <p>{$trip['start_date']} to {$trip['end_date']}</p>
                  <a href='trip_dashboard.php?trip_id={$trip['trip_id']}' class='btn btn-primary btn-sm'>Open Trip</a>
                </div>
              </div>
            </div>";
        }
    } else {
        echo "<p class='text-center'>No trips yet. <a href='add_trip.php'>Add a new trip</a></p>";
    }
    ?>
  </div>
</div>
</body>
</html>
