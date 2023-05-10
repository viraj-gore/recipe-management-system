<?php include 'header.php'; ?>
    <h1>Add Recipe</h1>
    <form method="POST" action="save_recipe.php">
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select a category</option>
                <?php
                // Fetch categories from the database and populate the dropdown list
                $conn = mysqli_connect("localhost", "root", "Viraj@00593", "recipe management system",3308);
                $result = mysqli_query($conn, "SELECT * FROM category");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='".$row['id']."'>".$row['name']."</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="ingredients">Ingredients</label>
            <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required></textarea>
            <small class="form-text text-muted">Enter each ingredient on a new line.</small>
        </div>
        <div class="form-group">
            <label>Instructions</label>
            <textarea name="instructions" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save Recipe</button>
        </div>
    </form>
</div>

</body>
</html>
