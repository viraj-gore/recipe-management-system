<?php
    include 'header.php';
    include 'credentials.php';
// Establish database connection
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3308);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Retrieve all recipes
    $sql = "SELECT * FROM recipe";
    $result = mysqli_query($conn, $sql);

    // Close database connection
    mysqli_close($conn);
?>
<h1 class="text-center">Recipes</h1>
<hr>
<div class="list-group">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <a href="recipe.php?id=<?php echo $row['id']; ?>" class="list-group-item">
            <?php echo $row['title'];?>
        </a>
    <?php endwhile;?>
</div>
<?php include 'footer.php'?>
