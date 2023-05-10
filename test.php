<!DOCTYPE html>
<html>
<head>
    <title>Add Recipe</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1>Add Recipe</h1>
        <form action="save_recipe.php" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    // Establish database connection
                    $dbhost = 'localhost';
                    $dbname = 'your_database_name';
                    $dbuser = 'your_database_user';
                    $dbpass = 'your_database_password';
                    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Query category data
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);

                    // Generate category options
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='{$row['id']}'>{$row['name']}</option>";
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required></textarea>
                <small class="form-text text-muted">Enter each ingredient on a new line.</small>
            </div>
            <div class="form-group">
                <label for="instructions">Instructions</label>
                <textarea class="form-control" id="instructions" name="instructions" rows="6" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</body>
</html>
