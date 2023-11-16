<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="images/sentiment-analysis.png">
    <title>LOGIN -- Sentiment Analysis</title>
    <style>
        input[type=email],input[type=passowrd]
        {
            width:25vw;
        }
    </style>
  </head>
  <body>

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

</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>


<?php
session_start();
include('db_connection.php');
if(isset($_POST['u_login']))
{
    $username = $_POST['u_username'];
    $password = md5($_POST['u_password']);

    $sql = "SELECT u_name, u_role FROM users WHERE u_username='$username' AND u_password='$password'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) 
    {
      while($row = $result->fetch_assoc()) 
      {
        if($row['u_role'] == 'Admin')
        {
            $_SESSION['u_username'] = $username;
            $_SESSION['u_name'] = $row['u_name'];
            $_SESSION['u_role'] = $row['u_role'];
            header("Location: admin_dash.php");
        }
        elseif($row['u_role'] == 'Logined User')
        {
            $_SESSION['u_username'] = $username;
            $_SESSION['u_name'] = $row['u_name'];
            $_SESSION['u_role'] = $row['u_role'];
            header("Location: logined_user_dash.php");  
        }
        else
        {
            echo "Failed";
        }
      }
    } else {
      echo "0 results";
    }
}

?>