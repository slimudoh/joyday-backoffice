<?php
session_start();
include './inc/connection.php';

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){
      $email = $conn -> real_escape_string($_POST['email']);
      $pwd = $conn -> real_escape_string($_POST['password']);

      // $password = password_hash($pwd, PASSWORD_DEFAULT);

      $options = [
            'cost' => 12,
        ];
        $password = password_hash($pwd, PASSWORD_BCRYPT, $options);

    $sql = "SELECT * FROM user WHERE email='$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
        echo "<script>alert('Account already exist. Please go and signin.')</script>";
      } else {
        $sql="INSERT INTO user (email, password, active, date_created) VALUES ('$email', '$password', 0, NOW())";
        if ($conn -> query($sql)) {
          echo "<script>alert('Account created successfully. Please contact admin for activation.')</script>";
          // header("Location: ./index.php");
          // exit();
        }
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
          <h6>Register</h6>
          <p>
            Please note that after registration, the account will be active after it is activated by the administrator.
          </p>
          <div>
            <div>
              <label>Email</label>
              <input type="email" name="email" required/>
            </div>
            <div>
              <label>Password</label>
              <input type="password" name="password" required/>
            </div>
            <button name="submit">Register</button>
          </div>

          <p>
            <a href="./index.php">Go to signin</a>
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
