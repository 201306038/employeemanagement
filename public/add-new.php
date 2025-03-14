<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $full_name = $_POST['full_name'];
   $salary = $_POST['salary'];
   $employment_date = $_POST['employment_date'];
   $employer_id = $_POST['employer_id'];

   $sql = "INSERT INTO `employee`(`national_id`, `full_name`, `salary`, `employment_date`, `employer_id`) VALUES (NULL,'$full_name','$salary','$employment_date','$employer_id')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: index.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>
<!-- Include Header & CSS -->
<?php include "nav.php"; ?>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Employee</h3>
         <p class="text-muted">Complete the form below to add a new Employee</p>
      </div>

      <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Full Name:</label>
                  <input type="text" class="form-control" name="full_name" placeholder="David Hangula" required>
               </div>

               <div class="col">
                  <label class="form-label">Salary:</label>
                  <input type="number" min="500" class="form-control" name="salary" placeholder="In N$" required>
               </div>
            </div>

            <div class="mb-3">
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
            </div>

            <div class="form-group mb-3">
               <label>Date Started:</label>
               &nbsp;
               <input type="date" class="form-control" name="employment_date" id="employment_date" required>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">Save</button>
               <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
   </div>
<!-- Include Footer & JavaScripts -->
<?php include "footer.php"; ?>