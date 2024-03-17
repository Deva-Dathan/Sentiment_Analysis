
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="images/sentiment-analysis.png">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <title>LOGIN -- Sentiment Analysis</title>
    <style>
        input[type=email],input[type=passowrd]
        {
            width:25vw;
        }   
        .back-btn
        {
          background: none;
          outline: none;
          border: none;
          font-size: 20px;
          font-weight: bold;
        }
    </style>
  </head>

  <body>

  <?php
  session_start();
          if(isset($_SESSION['reg_success']))
          {
            ?>
          <div class="alert alert-success mt-3 text-center font-weight-bold" role="alert"><?php echo $_SESSION['reg_success'];?></div>
          <?php
            unset($_SESSION['reg_success']);
          }
          ?>

<a href="landing_page.php"><button class="back-btn"><i class='bx bx-arrow-back'></i></button></a>

<div class="container min-vh-100 d-flex justify-content-center align-items-center">
  <form method="POST">
  <h1 class="text-center font-weight-bold mb-3">LOGIN</h1>  
  <div class="form-outline mb-4">
    <input type="email" name="u_username" id="form2Example1" class="form-control" placeholder="USERNAME" required>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" name="u_password" id="form2Example2" class="form-control" placeholder="PASSWORD" required>
  </div>

  <!-- Submit button -->
  <button type="submit" name="u_login" class="btn btn-primary btn-block mb-4">Log in</button>
  <a href="register_page.php" class="btn btn-danger btn-block mb-4" style="text-decoration:none;">Register</a>
    <!-- Register buttons -->
    <div class="text-center">
    <div class="col">
      <!-- Simple link -->
      <a href="#!">Forgot password</a>
    </div>
      </div>
</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>


<?php
session_start();
include('db_connection.php');
if(isset($_POST['u_login']))
{
    $username = $_POST['u_username'];
    $password = md5($_POST['u_password']);

    $sql = "SELECT u_name FROM users WHERE u_username='$username' AND u_password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
        $_SESSION['u_username'] = $username;
        $_SESSION['u_name'] = $row['u_name'];
        header("Location: Admin/text_analysis.php");
      }
    } else {
      echo "0 results";
    }
}

?>