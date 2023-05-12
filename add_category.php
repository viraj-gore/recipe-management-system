<?php
include 'header.php';
// Establish database connection
include 'db.php';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    // Retrieve form data
    $name = $_POST['name'];

    // Check if category already exists
    $check_sql = "SELECT id FROM category WHERE name = '$name'";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        // Category already exists
        echo '<script>alert("Category already exists!")</script>';
    } else {
        // Insert new category
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        if (mysqli_query($conn, $sql)) {
            // Category added successfully
            echo '<script>alert("Category added successfully!")</script>';
        } else {
            // Error adding category
            echo '<script>alert("Error adding category!")</script>';
        }
    }
}

// Close database connection
mysqli_close($conn);
?>
<h1 class="text-center">Add Category</h1>
<hr>
<form method="post">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Add Category</button>
</form>
<?php include 'footer.php'; ?>
