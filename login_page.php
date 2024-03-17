
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
@import url('https://fonts.googleapis.com/css?family=Raleway:400,700');


body{
  min-height:100vh;
  font-family: 'Raleway', sans-serif;
  overflow: hidden;
}

.container{
  width:100%;
  height:100%;
  
  &:hover,&:active{
    .top, .bottom{
      &:before, &:after{
        margin-left: 200px;
        transform-origin: -200px 50%;
        transition-delay:0s;
      }
    }
    
    .center{
      opacity:1;
      transition-delay:0.2s;
    }
  }
}

.top, .bottom{
  &:before, &:after{
    content:'';
    display:block;
    position:absolute;
    width:200vmax;
    height:200vmax;
    top:50%;left:50%;
    margin-top:-100vmax;
    transform-origin: 0 50%;
    transition:all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
    z-index:10;
    opacity:0.65;
    transition-delay:0.2s;
  }
}

.top{
  &:before{transform:rotate(45deg);background:#e46569;}
  &:after{transform:rotate(135deg);background:#ecaf81;}
}

.bottom{
  &:before{transform:rotate(-45deg);background:#60b8d4;}
  &:after{transform:rotate(-135deg);background:#3745b5;}
}

.center{
  position:absolute;
  width:400px;
  height:400px;
  top:50%;left:50%;
  margin-left:-200px;
  margin-top:-200px;
  display:flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding:30px;
  opacity:0;
  transition:all 0.5s cubic-bezier(0.445, 0.05, 0, 1);
  transition-delay:0s;
  color:#333;
  
  input{
    width:100%;
    padding:15px;
    margin:5px;
    border-radius:1px;
    border:1px solid #ccc;
    font-family:inherit;
  }

}
    </style>
  </head>

  <body>
  
<form method="post">
<div class="container" onclick="">
  <div class="top"></div>
  <div class="bottom"></div>
  <div class="center">
    <h2>Please Sign In</h2>
    <h5>
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
    </h5>
    <input type="email" name="u_username" id="form2Example1" class="form-control" placeholder="USERNAME" required>
    <input type="password" name="u_password" id="form2Example2" class="form-control" placeholder="PASSWORD" required>


    <div class="row mt-5 text-center">
    <div class="col-md-6">
        <button type="submit" name="u_login" class="btn btn-primary btn-block mb-4">Log in</button>
    </div>
    <div class="col-md-6">
        <a href="register_page.php" class="btn btn-danger btn-block mb-4" style="text-decoration:none;">Register</a>
    </div>
</div>
</form>


  </div>
</div>



    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>


<?php
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