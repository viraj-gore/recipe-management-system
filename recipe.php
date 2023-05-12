<?php
include 'header.php';
// Establish database connection
include 'db.php';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get recipe ID from URL parameter
$recipe_id = $_GET['id'];
// Retrieve recipe data for selected recipe
$recipe_id = $_GET['id'];
$sql = "SELECT get_recipe($recipe_id) AS recipe_data";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$recipe_data = $row['recipe_data'];

// Parse the recipe data into separate variables
list($title,$category_id,$instructions, $ingredients) = explode('#', $recipe_data);
// Retrieve all categories
$sql = "SELECT * FROM category ORDER BY name ASC";
$categories = mysqli_query($conn, $sql);
mysqli_close($conn); // Close database connection
?>
<h1><?php echo $title; ?></h1>
<p> 
    <?php while ($row = mysqli_fetch_assoc($categories)): ?>
        <?php if($category_id == $row['id']) { echo $row['name']; } ?>
    <?php endwhile; ?>
</p>
<hr>
<p><?php echo $instructions; ?></p>
<hr>
<h2>Ingredients</h2>
<ul style="margin-bottom: 8px;" class="list-group">
    <?php 
        $ingredient_list = explode('|',$ingredients);
        foreach ($ingredient_list as $ingredient): ?>
            <li class="list-group-item"><?php echo $ingredient; ?></li>
    <?php endforeach; ?>
</ul>
<a href="edit_recipe.php?id=<?php echo $recipe_id; ?> " class="btn btn-primary" > Edit Recipe </a>
<a href="delete_recipe.php?id=<?php echo $recipe_id; ?> " class="btn btn-danger" > Delete Recipe </a>
<?php
include 'footer.php';
?>