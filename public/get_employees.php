<?php
require_once "db_conn.php";

if (isset($_GET['employer_id'])) {
    $employer_id = $_GET['employer_id'];

    $query = "SELECT * FROM employee WHERE employer_id = $employer_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<li>" . htmlspecialchars($row['full_name']) . "</li>";
        }
    } else {
        echo "<li>No employees found.</li>";
    }
}
?>
