<?php
  session_start();
  session_destroy();
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
    <div class="auth_container">
      <div>
        <div>
          <h4 style="text-align: center;margin: 0;">
            GIFTWAVE TECHNOLOGIES LIMITED
          </h4>
            <h1 style="text-align: center;margin-top: 0;">OURJOYDAY</h1>
          <h6>You are logged out</h6>
          <p>
            <a href="index.php">Go to signin</a>
          </p>
        </div>
      </div>
    </div>
  </body>
</html>
