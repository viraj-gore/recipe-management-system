  <h2>User Registration Form</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" name="email" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Register</button>
  </form>

  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve form data
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      
      // Connect to database
      $db_host = "localhost";
        $db_username = "root";
        $db_password = "Viraj@00593";
        $db_name = "recipe management system";
        
      $conn = mysqli_connect($db_host, $db_username, $db_password, $db_name,3308);
      
      if(!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      
      // Check if username already exists
      $sql = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">Username already exists. Please choose a different username.</div>';
      } else {
        // Insert new user into database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        
        if(mysqli_query($conn, $sql)) {
          echo '<div class="alert alert-success" role="alert">User registered successfully.</div>';
        } else {
          echo '<div class="alert alert-danger" role="alert">Error: ' . mysqli_error($conn) . '</div>';
        }
      }
      
      // Close database connection
      mysqli_close($conn);
    }
  ?>
