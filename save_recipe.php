<?php
// Establish database connection
include 'db.php';


// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Parse form data
$title = $_POST['title'];
$category_id = $_POST['category_id'];
$ingredients = explode("\n", $_POST['ingredients']);
$instructions = $_POST['instructions'];

// Insert recipe data
$sql = "INSERT INTO recipe (title, category_id, instructions) VALUES ('$title', $category_id, '$instructions')";
mysqli_query($conn, $sql);
$recipe_id = mysqli_insert_id($conn);

// Insert ingredient data
foreach ($ingredients as $ingredient) {
    $ingredient = trim($ingredient);
    if (!empty($ingredient)) {
        $sql = "INSERT INTO ingredient (name) VALUES ('$ingredient')";
        mysqli_query($conn, $sql);
        $ingredient_id = mysqli_insert_id($conn);
        echo $ingredient_id;
        $sql = "INSERT INTO recipe_ingredient (recipe_id, ingredient_id) VALUES ($recipe_id, $ingredient_id)";
        mysqli_query($conn, $sql);
    }
}

// Close database connection
mysqli_close($conn);

// Redirect to recipe page
header("Location: recipe.php?id=$recipe_id");
exit();
?>