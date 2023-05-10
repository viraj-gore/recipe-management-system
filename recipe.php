<?php
include 'header.php';
// Establish database connection
include 'credentials.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3308);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get recipe ID from URL parameter
$recipe_id = $_GET['id'];

// Query recipe data
$sql = "SELECT r.title, c.name as category_name, r.instructions 
        FROM recipe r
        JOIN category c ON r.category_id = c.id
        WHERE r.id = $recipe_id";
$result = mysqli_query($conn, $sql);
$recipe = mysqli_fetch_assoc($result);

// Query ingredient data
$sql = "SELECT i.name 
        FROM ingredient i
        JOIN recipe_ingredient ri ON i.ingredient_id = ri.ingredient_id
        WHERE ri.recipe_id = $recipe_id";
$result = mysqli_query($conn, $sql);
$ingredients = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Display recipe data
echo "<h1>{$recipe['title']}</h1>";
echo "<p><strong>Category:</strong> {$recipe['category_name']}</p>";
echo "<p><strong>Ingredients:</strong></p>";
echo "<ul>";
foreach ($ingredients as $ingredient) {
    echo "<li>{$ingredient['name']}</li>";
}
echo "</ul>";
echo "<p><strong>Instructions:</strong></p>";
echo "<p>{$recipe['instructions']}</p>";

// Close database connection
mysqli_close($conn);
include 'footer.php';
?>
