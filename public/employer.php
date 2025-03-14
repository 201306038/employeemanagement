<?php include "nav.php"; ?>

<div class="container">
    <div class="text-center mb-4">
        <h3>Employer Management</h3>
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
        <a href="add-employee.php" class="btn btn-dark mb-3">Add New</a>

        <table id="myTable" class="table table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Company Name</th>
                    <th scope="col">Registration Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `employer`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td>
                            <a href="#" class="employer-link" data-bs-toggle="modal" data-bs-target="#employeeModal" data-employer-id="<?php echo $row['employer_id']; ?>">
                                <?php echo $row["company_name"] ?>
                            </a>
                        </td>
                        <td><?php echo $row["registration_date"] ?></td>
                        <td>
                            <a href="editemployer.php?id=<?php echo $row["employer_id"] ?>" class="link-dark">
                                <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                            </a>
                            <a href="delete.php?id=<?php echo $row['employer_id']; ?>&action=delete_employer" class="link-dark">
                                <i class="fa-solid fa-trash fs-5"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Employee Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-labelledby="employeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Employees List</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul id="employeeList"></ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.employer-link').forEach(link => {
        link.addEventListener('click', function() {
            let employerId = this.getAttribute('data-employer-id');

            fetch('get_employees.php?employer_id=' + employerId)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('employeeList').innerHTML = data;
                });
        });
    });
});
</script>

<?php include "footer.php"; ?>
