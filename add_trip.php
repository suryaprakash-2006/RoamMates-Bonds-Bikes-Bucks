<?php include("config/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Trip - RoamMates</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include("navbar.php"); ?>

<div class="container mt-5">
    <h2>Add New Trip</h2>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $trip_name = $_POST['trip_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        $stmt = $conn->prepare("INSERT INTO trips (trip_name, start_date, end_date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $trip_name, $start_date, $end_date);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Trip added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
    ?>
    <form method="POST" class="card p-4 shadow-sm">
        <div class="mb-3">
            <label>Trip Name</label>
            <input type="text" name="trip_name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Start Date</label>
            <input type="date" name="start_date" class="form-control">
        </div>
        <div class="mb-3">
            <label>End Date</label>
            <input type="date" name="end_date" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Add Trip</button>
    </form>
</div>
</body>
</html>
