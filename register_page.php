<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
include("db_connection.php");
$name = $_POST['u_name'];
$username = $_POST['username'];
$mobile = $_POST['mobile'];
$password = md5($_POST['password']);
$verifypw = md5($_POST['verifypassword']);

if($password == $verifypw)
{
$sql = "INSERT INTO users (u_name, mobile, u_username, u_password) VALUES ('$name', '$mobile', '$username', '$verifypw')";

if ($conn->query($sql) === TRUE) {
  $_SESSION['reg_success'] = "REGISTERATION SUCCESSFULLY";
  header("Location:login_page.php");
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
}

$conn->close();
}
?>

<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <!--<title>Registration Form in HTML CSS</title>-->
    <!---Custom CSS File--->
    <style>
      /* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
  background: rgb(130, 106, 251);
}
.container {
  position: relative;
  max-width: 700px;
  width: 100%;
  background: #fff;
  padding: 25px;
  border-radius: 8px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}
.container header {
  font-size: 1.5rem;
  color: #333;
  font-weight: 500;
  text-align: center;
}
.container .form {
  margin-top: 30px;
}
.form .input-box {
  width: 100%;
  margin-top: 20px;
}
.input-box label {
  color: #333;
}
.form :where(.input-box input, .select-box) {
  position: relative;
  height: 50px;
  width: 100%;
  outline: none;
  font-size: 1rem;
  color: #707070;
  margin-top: 8px;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 0 15px;
}
.input-box input:focus {
  box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1);
}
.form .column {
  display: flex;
  column-gap: 15px;
}

.form .passwordColumn {
  display: flex;
  column-gap: 15px;
}

.form button {
  height: 55px;
  width: 100%;
  color: #fff;
  font-size: 1rem;
  font-weight: 400;
  margin-top: 30px;
  border: none;
  cursor: pointer;
  transition: all 0.2s ease;
  background: rgb(130, 106, 251);
}
.form button:hover {
  background: rgb(88, 56, 250);
}
/*Responsive*/
@media screen and (max-width: 500px) {
  .form .column {
    flex-wrap: wrap;
  }
}
    </style>
  </head>
  <body>
    <section class="container">
      <header>Registration Form</header>
      <form method="POST" class="form">
        <div class="input-box">
          <label>Full Name</label>
          <input type="text" placeholder="Enter full name" name="u_name" required />
        </div>

        <div class="input-box">
          <label>Email Address</label>
          <input type="text" placeholder="Enter email address" name="username" required />
        </div>

        <div class="column">
          <div class="input-box">
            <label>Phone Number</label>
            <input type="number" placeholder="Enter phone number" name="mobile" required />
          </div>
        </div>

        <div class="passwordColumn">
          <div class="input-box">
            <label>Password</label>
            <input type="password" placeholder="Password" name="password" required />
          </div>
          <div class="input-box">
            <label>Confirm Password</label>
            <input type="password" placeholder="Confirm Password" name="verifypassword" required />
          </div>
        </div>

        <button type="submit">Register</button>
      </form>
    </section>
  </body>
</html>
