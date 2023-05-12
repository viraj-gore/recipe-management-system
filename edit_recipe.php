<?php
include 'header.php';
// Establish database connection
include 'db.php';
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

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
// Close database connection
mysqli_close($conn);
?>
<h1 class="text-center">Edit Recipe</h1>
<hr>
<form action="save_recipe.php" method="post">
    <input type="hidden" name="id" value="<?php echo $recipe_id; ?>">
    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" class="form-control" id="title" name="title" value="<?php echo $title ?>" required>
    </div>
    <div class="form-group">
        <label for="category">Category:</label>
        <select class="form-control" id="category" name="category_id" required>
            <?php while ($row = mysqli_fetch_assoc($categories)): ?>
                <option value="<?php echo $row['id']; ?>" <?php if($category_id == $row['id']) { echo 'selected'; } ?>><?php echo $row['name']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="instructions">Instructions:</label>
        <textarea class="form-control" id="instructions" name="instructions" rows="5" required><?php echo $instructions; ?></textarea>
    </div>
    <div class="form-group">
        <label for="ingredients">Ingredients:</label>
        <textarea class="form-control" id="ingredients" name="ingredients" rows="5" required>
            <?php 
                $ingredient_list = explode('|',$ingredients);
                foreach($ingredient_list as $ingredient): ?>
                    <?php echo ltrim($ingredient,"")."\n"; ?>
            <?php endforeach; ?>
        </textarea>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="index.php" class="btn btn-danger">Cancel</a>
</form>
<?php include 'footer.php' ?>