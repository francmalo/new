<?php
// Function to ease with redirecting to other pages
function redirect($string)
{

    header("Location: $string");
}

// Fuction to delete a student from the database
function delete_student($id, $students)
{

    global $conn;

    $sql = "DELETE FROM student WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        echo "Student Deleted Succesfully";
    } else {
        echo "Failed To Delete Student";
    }

    redirect($students);
}
