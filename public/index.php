<?php include "nav.php"; ?>

  <div class="container">
      <div class="text-center mb-4">
         <h3>Employee Management</h3>
      </div>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <a href="add-new.php" class="btn btn-dark mb-3">Add New</a>

    <table class="table table-hover text-center" class="display" id="myTable">
      <thead class="table-dark">
        <tr>
          <th scope="col">National ID</th>
          <th scope="col">Full Name</th>
          <th scope="col">Salary</th>
          <th scope="col">Employment Date</th>
          <th scope="col">Employer</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM `vw_employee_employer`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
          <tr>
            <td><?php echo $row["national_id"] ?></td>
            <td><?php echo $row["full_name"] ?></td>
            <td><?php echo $row["salary"] ?></td>
            <td><?php echo $row["employment_date"] ?></td>
            <td><?php echo $row["company_name"] ?></td>
            <td>
              <a href="edit.php?id=<?php echo $row["national_id"] ?>" class="link-dark"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
              <a href="delete.php?id=<?php echo $row['national_id']; ?>&action=delete_employee" class="link-dark"><i class="fa-solid fa-trash fs-5 btn-danger"></i></a>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>

<?php include "footer.php"; ?>