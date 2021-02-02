<?php
session_start();
include './inc/connection.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
      $email = $conn -> real_escape_string($_POST['email']);
      $password = $conn -> real_escape_string($_POST['password']);


      $sql = "SELECT * FROM user WHERE email='$email'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $hash = $row["password"];
            if (password_verify($password, $hash)) {
              if ($row["active"] == 1) {
                $_SESSION['user_id'] = $row["id"];
                $_SESSION['start'] = time();
                $_SESSION['expire'] = $_SESSION['start'] + 3600;
                  header("Location: ./sales-history.php");
                  exit();
              } else {
                  echo "<script>alert('Account is not active yet. Please contact the admin.')</script>";
              }
            } else {
              echo "<script>alert('Wrong/Password email.')</script>";
            }
          }
      } else {
        echo "<script>alert('Email does not exist.')</script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Admin</title>

    <link href="./assets/css/style.css" rel="stylesheet" />
  </head>
  <body>
    <form method="post" action="">
    <div class="auth_container">
      <div>
        <div>
          <h4 style="text-align: center;margin: 0;">
            GIFTWAVE TECHNOLOGIES LIMITED
          </h4>
          <h1 style="text-align: center;margin-top: 0;">OURJOYDAY</h1>
          <h6>Sign in</h6>
          <div>
            <div>
              <label>Email</label>
              <input type="email" name="email" required/>
            </div>
            <div>
              <label>Password</label>
              <input type="password" name="password" required/>
            </div>
            <button name="submit">Login</button>
          </div>

          <p>
            <a href="./register.php">Add a new account</a>
          </p>
        </div>
      </div>
    </div>
      </form>

    <?php
      $conn->close();
    ?>
  </body>
</html>
