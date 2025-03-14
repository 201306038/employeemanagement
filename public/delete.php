<?php
include "db_conn.php";
$action = $_GET["action"];
$id = $_GET["id"];
if ($action == "delete_employee") {
  $sql = "DELETE FROM `employee` WHERE national_id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Employee deleted successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}elseif ($action == "delete_employer") {
  $sql = "DELETE FROM `employer` WHERE employer_id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: employer.php?msg=Employer deleted successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}
?>
