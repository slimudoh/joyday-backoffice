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

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['submit'])){

      $sales_firstname = $conn -> real_escape_string($_POST['sales_firstname']);
      $sales_lastname = $conn -> real_escape_string($_POST['sales_lastname']);
      $sales_admin = $conn -> real_escape_string($_POST['sales_admin']);
      $sales_amount = $conn -> real_escape_string($_POST['sales_amount']);
      $sales_comment = $conn -> real_escape_string($_POST['sales_comment']);

      $sql="INSERT INTO sales (date_created, firstname, lastname, admin, amount, comment) VALUES (NOW(), '$sales_firstname', '$sales_lastname', '$sales_admin', '$sales_amount', '$sales_comment')";

      if ($conn -> query($sql)) {
        header("Location: ./sales-history.php");
        exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
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
      <h3>Add New Sale</h3>
      <p>
        Add a new sale record.
      </p>
      <div>
        <div class="add_new">
          <div>
            <form method="post" action="">
            <div>

              <div class="box_input">
                <label>User's Firstname </label>
                <div>
                  <input  type="text" required name="sales_firstname"  />
                </div>
              </div>

              <div class="box_input">
                <label>User's Lastname </label>
                <div>
                  <input  type="text" required name="sales_lastname"  />
                </div>
              </div>

              <div class="box_input">
                <label>Administrator</label>
                <div>
                  <select name="sales_admin" required>
                    <option >

                    </option>
                    <option value="Q">
                      Q
                    </option>
                    <option value="teju">
                      Teju
                    </option>
                    <option value="uwem">
                      Uwem
                    </option>
                  </select>
                </div>
              </div>

              <div class="box_input">
                <label>Amount Paid </label>
                <div>
                  <input  type="number" required name="sales_amount"  />
                </div>
              </div>

              <div class="box_text">
                <label>Description of the experience</label>
                <div>
                  <textarea name="sales_comment" cols="30" rows="10" required></textarea>
                </div>
              </div>

              <div class="box_btn">
                <button name="submit" style="color: #fff; background-color: green;">SUBMIT</button>
              </div>

            </div>
          </form>
          </div>

        </div>
      </div>
    </div>
    <?php
        $conn->close();
    ?>
  </body>
</html>
