
<?php
// Check existence of id parameter before processing further
if(isset($_GET["student_id"]) && !empty(trim($_GET["student_id"]))){
    // Include config file
    require_once "config.php";
    // Prepare a select statement
    $sql = "SELECT * FROM student WHERE student_id = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        // Set parameters
        $param_id = trim($_GET["student_id"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $student_id = $row['student_id'];
                $firstname = $row["first_name"];
                $lastname = $row["last_name"];
                $age = $row['age'];
                $class = $row['class'];
                $gender = $row['gender'];
                //$image=$row['image'];
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                  <table class="table  table-striped">
                  <h1 class="mt-5 mb-3">Student Details<h1> 

 <div class="form-group">
                        <tr>
                       <th> <label>#Student Id</label></th>
                        <td><b><?php echo $row["student_id"]; ?></b></td>
    </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                       <th> <label>First Name</label></th>
                        <td><b><?php echo $row["first_name"]; ?></b></td>
    </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                      <th>  <label>Last Name</label></th>
    
                        <td><b><?php echo $row["last_name"]; ?></b></td>
                        </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                        <th><label>Age</label></th>
                        <td><b><?php echo $row["age"]; ?></b></td>
    </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                       <th> <label>Class</label></th>
                        <td><b><?php echo $row["class"]; ?></b></td>
    </tr>
                    </div>
                    <div class="form-group">
                        <tr>
                            <th><label>Gender</label></th>
                        <td><b><?php if ($gender == "M") echo $gender . "ale";
                                                        elseif (($gender == "F")) echo $gender . "emale";
                                                        elseif (($gender == "O")) echo $gender . "ther"; ?>
                    </b></td>
    </tr>
                    </div>
                    <div class="form-group">
                    <tr>   
                    <th><label>Student Image</label></th>
                        <td><b>  <img src="uploads/<?php echo $row['student_image'];?>" width="100px" h
                                                    eight="100px">    </b></td>
    </tr>
                    </div>

                    </table>
                    <p><a href="display_students.php" class="btn btn-primary">Back</a></p>

                 
                </div>
            </div>        
        </div>
    </div>
</body>
</html>