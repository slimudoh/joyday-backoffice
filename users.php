<?php
session_start();
include './inc/connection.php';
$now = time();
if ($now > $_SESSION['expire']) {
    session_destroy();
    header("Location: ./index.php");
    exit();
}

if (isset( $_SESSION['user_id'] ) ) {
  $user = $_SESSION['user_id'];
    $sql = "SELECT * FROM user WHERE id=$user";
    $result = $conn->query($sql);
    if ($result->num_rows < 1) {
      header("Location: ./index.php");
      exit();
    }
} else {
  header("Location: ./index.php");
  exit();
}


if (isset($_GET['id'])) {
  $data_id = $_GET['id'];

  $sql = "DELETE FROM signup WHERE id=$data_id";

  if ($conn->query($sql) === TRUE) {
    header("Location: ./users.php");
  } else {
    echo "Error deleting record: " . $conn->error;
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>

    <link href="./assets/css/style.css" rel="stylesheet" />
  </head>
  <body>
    <?php
    include './inc/header.php';
    include './inc/sidebar.php';
    ?>
    <div class="content_container">
      <h3>Sign Ups</h3>
      <?php
              $sql = "SELECT * FROM signup";
              if ($result = mysqli_query($conn, $sql)) {
                  $rowcount = mysqli_num_rows($result);
                  echo "<p style='text-align: center;font-size: 20px;'>We have <span>" . $rowcount . "</span> records here.
                  </p>";
                  mysqli_free_result($result);
              }
        ?>
      <div>
        <div class="sales_history">
          <table>
            <thead>
                <tr>
                  <th>S/N</th>
                  <th>DATE CREATED</th>
                  <th>NAME</th>
                  <th>PARTNER</th>
                  <th>WHATSAPP</th>
                  <th>EMAIL</th>
                  <th>BIG DATE</th>
                  <th>VENUE</th>
                  <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
              <?php
                $sql = "SELECT * FROM signup ORDER BY id DESC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                  $x = 1;
                  while($row = $result->fetch_assoc()) {
                      echo '<tr><td>';
                      echo $x;
                      echo '</td><td>';
                      echo $row["date_created"];
                      echo '</td><td>';
                      echo $row["firstname"] . " " . $row["lastname"];
                      echo '</td><td>';
                      echo $row["partner_firstname"] . " " . $row["partner_lastname"];
                      echo '</td><td>';
                      echo $row["whatsapp"];
                      echo '</td><td>';
                      echo $row["email"];
                      echo '</td><td>';
                      echo $row["day"];
                      echo '</td><td>';
                      echo $row["venue"];
                      echo '</td><td>';
                      echo '<div class="exp_box_card_delete" style="background-color: red;">';
                      echo '<a href="./users.php?id=';
                      echo $row["id"];
                      echo '">';
                      echo '<div style="padding: 15px 0;">';
                      echo "Delete";
                      echo '</div>';
                      echo '</a>';
                      echo '</div>';
                      echo '</td></tr>';
                      $x++;
                  }
                }
                $conn->close();
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
