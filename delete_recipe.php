<?php
// Establish database connection
include 'credentials.php';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,3308);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if recipe ID is set
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete recipe from database
    $sql = "DELETE FROM recipe WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check if delete query was successful
    if ($result) {
        echo "Recipe deleted successfully.";
    } else {
        echo "Error deleting recipe: " . mysqli_error($conn);
    }
} else {
    echo "No recipe ID specified.";
}

// Close database connection
mysqli_close($conn);
// Redirect to recipes page
header("Location: index.php");
?>
