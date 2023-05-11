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
mysqli_close($conn); // Close database connection
?>
<h1><?php echo $recipe['title']; ?></h1>
<hr>
<p><?php echo $recipe['instructions']; ?></p>
<hr>
<h2>Ingredients</h2>
<ul>
    <?php foreach ($ingredients as $ingredient): ?>
        <li><?php echo $ingredient['name']; ?></li>
    <?php endforeach; ?>
</ul>
<a href="edit_recipe.php?id=<?php echo $recipe_id; ?> " class="btn btn-primary" > Edit Recipe </a>
<a href="delete_recipe.php?id=<?php echo $recipe_id; ?> " class="btn btn-danger" > Delete Recipe </a>
<?php
include 'footer.php';
?>