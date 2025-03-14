<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $company_name = $_POST['company_name'];
  $registration_date = $_POST['registration_date'];

  $sql = "UPDATE `employer` SET `company_name`='$company_name',`registration_date`='$registration_date' WHERE employer_id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: employer.php?msg=Employer updated successfully" );
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}
?>
<?php
include "nav.php";
?>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Employer Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `employer` WHERE employer_id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">Company Name:</label>
            <input type="text" class="form-control" name="company_name" value="<?php echo $row['company_name'] ?>">
          </div>
            
        <div class="form-group mb-3">
          <label>Date Started:</label>
          &nbsp;
          <input type="date" class="form-control" name="registration_date"  value="<?php echo $row['registration_date'] ?>">
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <?php include "footer.php"; ?>