<?php
include "db_conn.php";
$id = $_GET["id"];

if (isset($_POST["submit"])) {
  $full_name = $_POST['full_name'];
  $salary = $_POST['salary'];
  $employer_id = $_POST['employer_id'];
  $employment_date = $_POST['employment_date'];

  $sql = "UPDATE `employee` SET `full_name`='$full_name',`salary`='$salary',`employer_id`='$employer_id',`employment_date`='$employment_date' WHERE national_id = $id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}
?>
<!-- Include Header & CSS -->
<?php
include "nav.php";
?>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit Employee Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM `employee` WHERE national_id = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Salary:</label>
            <input type="number" min="500" class="form-control" name="salary" value="<?php echo $row['salary'] ?>">
          </div>
        </div>

        <label class="form-label">Employer:</label>
        <?php
        require_once 'db_conn.php';

        // Fetch Employers for Dropdown
        $employers = mysqli_query($conn, "SELECT * FROM employer");

        ?>
        <select class="form-select" name="employer_id" required>
          <option value="">-- Select Employer --</option>
            <?php while ($row = mysqli_fetch_assoc($employers)): ?>
              <option value="<?= $row['employer_id'] ?>"><?= $row['company_name'] ?></option>
            <?php endwhile; ?>
        </select>

            
        <div class="form-group mb-3">
          <label>Date Started:</label>
          &nbsp;
          <input type="date" class="form-control" name="employment_date" id="employment_date" value="<?php echo $row['employment_date'] ?>">
        </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>
<!-- Include Footer & JavaScripts -->
  <?php include "footer.php"; ?>