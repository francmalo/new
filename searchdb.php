<?php
    if (isset($_POST['submit'])) {
        // Connect to the database
        $connection_string = new mysqli("localhost", "root", "safaricom", "studentdb");
        
        // Escape the search string and trim
        // all whitespace
        $searchString = mysqli_real_escape_string($connection_string, trim(htmlentities($_POST['search'])));

        // If there is a connection error, notify
        // the user, and Kill the script.
        if ($connection_string->connect_error) {
            echo "Failed to connect to Database";
            exit();
        }
  // Check for empty strings and non-alphanumeric
        // characters.
        // Also, check if the string length is less than
        // three. If any of the checks returns "true",
        // return "Invalid search string", and
        // kill the script.
        if ($searchString === "" || !ctype_alnum($searchString) || $searchString < 3) {
            echo "Invalid search string";
            exit();
        } 
          // We are using a prepared statement with the
        // search functionality to prevent SQL injection.
        // So, we need to prepend and append the search
        // string with percent signs
        $searchString = "%$searchString%";
       

        // The prepared statement
        $sql = "SELECT * FROM student WHERE first_name LIKE ?";

        // Prepare, bind, and execute the query
        $prepared_stmt = $connection_string->prepare($sql);
        $prepared_stmt->bind_param('s', $searchString);
        $prepared_stmt->execute();

           // Fetch the result
           $result = $prepared_stmt->get_result();

           if ($result->num_rows === 0) {
               // No match found
               echo "No match found";
               
               // Kill the script
               exit();
   
           } else {
               // Process the result(s)
               while ($row = $result->fetch_assoc()) {
                //echo "<b>id</b>: ". $row['id'] . "<br />";
                  // echo "<b>first_name</b>: ". $row['first_name'] . "<br />";
                  // echo "<b>last_name</b>: ". $row['last_name'] . "<br />";
                  // echo "<b>age</b>: ". $row['age'] . "<br />";
                  // echo "<b>gender</b>: ". $row['gender'] . "<br />";
                  // echo "<b>class</b>: ". $row['class'] . "<br />";
                  // echo "<b>image</b>: ". $row['image'] . "<br />";
                  $student_id = $row['student_id'];
                  $first_name = $row['first_name'];
                   $last_name = $row['last_name'];
                  $age = $row['age'];
                  $class = $row['class'];
                  $gender = $row['gender'];
                  

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
  <div id="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                <div id="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div id="content-wrapper">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12"> <h3>STUDENT</h3>
                                
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="POST" enctype="multipart/form-data">

  <table id="example" class="table table-dark table-hover">
                                        <thead>
                                            <tr>
                                                <th>Student Id</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Age</th>
                                                <th>Class</th>
                                                <th>Gender</th>
                                                <th>Student Image</th>
                                                <th>Edit</th>
                                                <th>Delete</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                  <tr style="cursor: pointer;">
                  <!-- Insert above php variables into respective <td> columns -->
                  <td><?php echo $student_id; ?></td>
                  
                  <td><?php echo $first_name; ?></td>
                  <td><?php echo $last_name; ?></td>
                  <td><?php echo $age; ?></td>
                  <td><?php echo $class; ?></td>
                  <!-- If $gender is equals 'M', concatenate it with 'ale',
                  elseif 'F', concatenate it with 'ale',
                  elseif 'O', concatenate it with 'ther'-->
                  <td><?php if ($gender == "M") echo $gender . "ale";
                      elseif (($gender == "F")) echo $gender . "emale";
                      elseif (($gender == "O")) echo $gender . "ther"; ?></td>
                  <td> <img src="uploads/<?php echo $row['student_image'];?>" width="100px" h
                  eight="100px"></td>
    
                                                    <!-- Add query string with fields action having value 'update' & id having value $id from a php variable -->
                                                    <td class="text-center"><a href="edit_student.php?action=update&student_id=<?php echo $student_id; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                                    <!-- Add query string with fields action having value 'delete' & id having value $id from a php variable -->
                                                    <td class="text-center"><a href="display_students.php?action=delete&student_id=<?php echo $student_id; ?>" class="btn btn-danger btn-sm" button onclick="return confirm('Are you sure you want to Delete?');" >Delete </a></td>

                                                 
                                                   


                                                
                                                    <td class="text-center"><a href="student_details.php?action=details&student_id=<?php echo $student_id; ?>" class="btn btn-info btn-sm">Details</a></td>
                                               


                  </tr>
                                        </tbody>
  </table>
  </table>
  <p><a href="display_students.php" class="btn btn-primary">Back</a></p>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    </body>
</html>

<?php




                } // end of while loop
            } // end of if($result->num_rows)
    
        } else { // The user accessed the script directly
    
            // Tell them nicely and kill the script.
            echo "That is not allowed!";
            exit();
        }
    ?>