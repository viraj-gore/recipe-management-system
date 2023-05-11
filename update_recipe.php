<?php
// Establish database connection
include 'credentials.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3308);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get recipe details
$id = $_POST['id'];
$title = $_POST['title'];
$instructions = $_POST['instructions'];
$category_id = $_POST['category_id'];

// Update recipe
$sql = "UPDATE recipe SET title='$title', instructions='$instructions', category_id='$category_id' WHERE id=$id";
$result = mysqli_query($conn, $sql);

// Delete existing recipe_ingredients
$sql = "DELETE FROM recipe_ingredient WHERE recipe_id=$id";
mysqli_query($conn, $sql);

// Insert new recipe_ingredients
$ingredients = explode("\n", $_POST['ingredients']);
foreach ($ingredients as $ingredient) {
    $ingredient = trim($ingredient);
    if (!empty($ingredient)) {
        $sql = "SELECT id FROM ingredient WHERE name='$ingredient'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            $ingredient_id = $row['id'];
        } else {
            $sql = "INSERT INTO ingredient (name) VALUES ('$ingredient')";
            mysqli_query($conn, $sql);
            $ingredient_id = mysqli_insert_id($conn);
        }
        $sql = "INSERT INTO recipe_ingredient (recipe_id, ingredient_id) VALUES ($id, $ingredient_id)";
        mysqli_query($conn, $sql);
    }
}

// Close database connection
mysqli_close($conn);

// Redirect to recipe page
header("Location: recipe.php?id=$id");
exit;
?>
