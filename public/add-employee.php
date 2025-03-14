<?php
include "db_conn.php";

if (isset($_POST["submit"])) {
   $company_name = $_POST['company_name'];
   $registration_date = $_POST['registration_date'];

   $sql = "INSERT INTO `employer`(`employer_id`, `company_name`, `registration_date`) VALUES (NULL,'$company_name','$registration_date')";

   $result = mysqli_query($conn, $sql);

   if ($result) {
      header("Location: employer.php?msg=New Company record created successfully");
   } else {
      echo "Failed: " . mysqli_error($conn);
   }
}
?>
<!-- Include Header & CSS -->
   <?php include "nav.php"; ?>

   <div class="container">
      <div class="text-center mb-4">
         <h3>Add New Employer</h3>
         <p class="text-muted">Complete the form below to add a new Employer</p>
      </div>

      <div class="container d-flex justify-content-center">
         <!-- Form to Add Employer-->
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Company/Organisation Name:</label>
                  <input type="text" class="form-control" name="company_name" placeholder="e.g Social Social Security" required>
               </div>

               <div class="col">
                  <label class="form-label">Registration Date:</label>
                  <input type="date" class="form-control" name="registration_date"  required>
               </div>
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