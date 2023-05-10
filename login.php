  <h2>User Login Form</h2>
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" required>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Login</button>
  </form>

  <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      // Retrieve form data
      $username = $_POST['username'];
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
      
      // Check if username and password match
      $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_num_rows($result) == 1) {
        echo '<div class="alert alert-success" role="alert">Login successful.</div>';
        // Start session and store user information
        session_start();
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
      } else {
        echo '<div class="alert alert-danger" role="alert">Invalid username or password. Please try again.</div>';
      }
      
      // Close database connection
      mysqli_close($conn);
    }
  ?>