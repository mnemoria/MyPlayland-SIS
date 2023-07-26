<?php
include('../../backend/server.php');

// Retrieve Value
if(isset($_POST['id'])){
    $id = $_POST['id'];

    $query = "SELECT * FROM subject_info WHERE id = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $response = array();

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $response = $row;
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'No data found for the given ID.'));
    }

    // Close the prepared statements
    mysqli_stmt_close($stmt);
}

// Update Database
if(isset($_POST['hidden_data'])){
    $id = $_POST['hidden_data'];
    $code = $_POST['update_code'];
    $name = $_POST['update_name'];
    $course = $_POST['update_course'];
    $date = $_POST['update_date'];
    $status = $_POST['update_status'];

    $query = "UPDATE subject_info SET subject_code=?, subject_name=?, course_id=?, date_added=?, status=? WHERE id=?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "ssissi", $code, $name, $course, $date, $status, $id);
    mysqli_stmt_execute($stmt);

    // Check if the update was successful
    $affectedRows = mysqli_affected_rows($connection);
    if ($affectedRows > 0) {
        echo("Subject Successfully Updated!");
    } else {
        echo("Error: Subject update failed.");
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

?>