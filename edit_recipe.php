<?php
include 'header.php';
// Establish database connection
include 'credentials.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3308);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve recipe data for selected recipe
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM recipe WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $recipe = mysqli_fetch_assoc($result);
}
$categories = mysqli_query($conn, "SELECT * FROM category");
$recipe_id = $_GET['id'];
// Query ingredient data
$sql = "SELECT i.name 
        FROM ingredient i
        JOIN recipe_ingredient ri ON i.ingredient_id = ri.ingredient_id
        WHERE ri.recipe_id = $recipe_id";
$result = mysqli_query($conn, $sql);
$ingredients = mysqli_fetch_all($result, MYSQLI_ASSOC);
// Close database connection
mysqli_close($conn);
?>
<h1 class="text-center">Edit Recipe</h1>
<hr>
<form action="save_recipe.php" method="post">
    <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $recipe['title']; ?>" required>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category_id" required>
            <?php while ($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['id']; ?>" <?php if ($recipe['category_id'] == $row['id']) { echo 'selected'; } ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="instructions">Instructions:</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="5" required><?php echo $recipe['instructions']; ?></textarea>
    </div>
    <div class="form-group">
        <label for="ingredients">Ingredients:</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required>
            <?php foreach ($ingredients as $ingredient): ?>
                <?php echo ltrim($ingredient['name'],"")."\n"; ?>
            <?php endforeach; ?>
        </textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="index.php" class="btn btn-default">Cancel</a>
</form>
<?php include 'footer.php' ?>