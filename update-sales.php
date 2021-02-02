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
      $sales_amount = $conn -> real_escape_string($_POST['sales_amount']);
      $sales_comment = $conn -> real_escape_string($_POST['sales_comment']);

    $data_id = $_GET['id'];
    $sql = "UPDATE sales SET firstname='$sales_firstname',lastname='$sales_lastname',amount='$sales_amount',comment='$sales_comment' WHERE id=$data_id";

       if ($conn->query($sql) === TRUE) {
        header("Location: ./sales-history.php");
         exit();
      } else {
        echo "Error updating record: " . $conn->error;
      }
    }
  }
?>

<?php
  if (isset($_GET['id'])) {
    $data_id = $_GET['id'];

    $sql = "SELECT * FROM sales WHERE id=$data_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
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
      <h3>Update Sales</h3>
      <p>
        Update a  record
      </p>
      <div>
        <div class="add_new">
          <div>
            <form method="post" action="">
            <div>

              <div class="box_input">
                <label>Firstname</label>
                <div>
                  <input name="sales_firstname" value="<?php echo $row['firstname'] ?? ''; ?>" type="text"   />
                </div>
              </div>

              <div class="box_input">
                <label>Lastname</label>
                <div>
                  <input name="sales_lastname" value="<?php echo $row['lastname'] ?? ''; ?>" type="text"    />
                </div>
              </div>

              <div class="box_input">
                <label>Administrator</label>
                <div>
                  <input  value="<?php echo $row['admin'] ?? ''; ?>" type="text" disabled    />
                </div>
              </div>

              <div class="box_input">
                <label>Amount</label>
                <div>
                  <input name="sales_amount" value="<?php echo $row['amount'] ?? ''; ?>" type="number"    />
                </div>
              </div>

              <div class="box_text">
                <label>Comment</label>

                <div>
                  <textarea name="sales_comment" cols="30" rows="10" required><?php echo $row['comment'] ?? ''; ?></textarea>
                </div>
              </div>

              <?php
                  }
                }
              }
              ?>

              <div class="box_btn">
                <button name="submit" style="color: #fff; background-color: green;">SUBMIT</div>
              </button>
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
