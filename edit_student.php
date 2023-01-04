<!-- Include the admin_header.php file to this page -->
<?php include_once("includes/admin_header.php"); ?>

<body id="page-top">

    <!-- Include admin_top_navigation.php file from includes folder -->
    <?php include_once("includes/admin_top_navigation.php"); ?>

    <div id="wrapper">

        <!-- Include the admin_sidebar_nav.php file to this home file -->
        <?php include_once("includes/admin_sidebar_nav.php"); ?>

        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <section style="width: 100%;" class="gradient-custom">
                        <div class="container h-60">
                            <div class="row justify-content-center align-items-center h-50">
                                <div class="col-12 col-lg-9 col-xl-7">
                                    <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                                        <div class="card-body p-4 p-md-5">
                                            <h3 class="mb-2 pb-2 pb-md-0 mb-md-2">Edit Student Details</h3>
                                            <?php
                                            // Check if the form submit button has been given the 'update_student' name
                                            if (isset($_POST['update_student'])) {
                                                // Assign the form's input values to PHP variables
                                                $first_name = $_POST['first_name'];
                                                $last_name = $_POST['last_name'];
                                                $age = (int)$_POST['age'];
                                                $class = "Class " . $_POST['class'];
                                                $gender_type = $_POST['inlineRadioOptions'];
                                                $student_id=$_GET['student_id'];
                                                // $students_image=$_FILES['image'];
                                                $students_image=$_FILES['image']['name'];
                                                // Switch the $gender_type defining and assigning to variable $gender a value according
                                                switch ($gender_type) {
                                                    case "option1":
                                                        $gender = 'F';
                                                        break;
                                                    case "option2":
                                                        $gender = 'M';
                                                        break;
                                                    case "option3":
                                                        $gender = 'O';
                                                        break;
                                                    default:
                                                        echo "Not valid gender!";
                                                }
                                                if ($students_image=='') {
                                                     // MySQL query to be made to the database in order to update values in the database
                                                   $sql = "UPDATE student SET first_name = '{$first_name}', last_name = '{$last_name}', age = '{$age}', class = '{$class}', gender = '{$gender}' WHERE student_id = '{$student_id}'";
                                                   $query = mysqli_query($conn, $sql);
                                                   redirect("display_students.php");
                                                } else{
                                                    $temp_students_image=$_FILES['image']['tmp_name'];
                                                move_uploaded_file($temp_students_image,"uploads/$students_image");
                                                $sql = "UPDATE student SET first_name = '{$first_name}', last_name = '{$last_name}', age = '{$age}', class = '{$class}', gender = '{$gender}', student_Image='{$students_image}' WHERE student_id ='{$student_id}'" ;
                                                $query=mysqli_query($conn, $sql);
                                                redirect("display_students.php");
                                               

                                                // Make connection to the MySQL database using connection details ($conn) and the MySQL query ($sql)
                                                // $query = mysqli_query($conn, $sql);
                                                // Redirect to display_students.php after successfully inserting students details into the database
                                              
                                                // Close MySQL connection
                                                $conn->close();
                                            }
                                        }
                                          
                                            ?>

                                            <form action="" method="post" enctype="multipart/form-data">
                                                <?php
                                                // Check if query string params consist the id value
                                                if (isset($_GET['student_id'])) {
                                                    // Assign id value to the $id variable
                                                    $student_id = $_GET['student_id'];
                                                    // MySQL query to select all information about the students from the database
                                                    $sql = "SELECT * FROM student WHERE student_id= '{$student_id}'";
                                                    // Make connection to the MySQL database using connection details ($conn) and the MySQL query ($sql)
                                                    $query = mysqli_query($conn, $sql);

                                                    // Assign student's details from the database to the respective variables
                                                    while ($row = mysqli_fetch_assoc($query)) {
                                                        $student_id = $row['student_id'];
                                                        $first_name = $row['first_name'];
                                                        $last_name = $row['last_name'];
                                                        $age = $row['age'];
                                                        $class = $row['class'];
                                                        $gender = $row['gender'];
                                                       // $filename=$row['image'];
                                                    
                                                ?>


                                                <input type="hidden" value="<?php echo $student_id; ?>" />

                                                <div class="row">
                                                    <div class="col-md-6 mb-4">

                                                        <div class="form-outline">
                                                            <!-- Add $first_name variable to the HTML value property -->
                                                            <input value="<?php echo $first_name; ?>" type="text"
                                                                id="first_name" class="form-control form-control-lg"
                                                                name="first_name" />
                                                            <label class="form-label" for="firstName">First Name</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4">

                                                        <div class="form-outline">
                                                            <!-- Add $last_name variable to the HTML value property -->
                                                            <input value="<?php echo $last_name; ?>" type="text"
                                                                id="last_name" class="form-control form-control-lg"
                                                                name="last_name" />
                                                            <label class="form-label" for="lastName">Last Name</label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6 mb-4 d-flex align-items-center">

                                                        <div class="form-outline datepicker w-100">
                                                            <!-- Add $age variable to the HTML value property -->
                                                            <input value="<?php echo $age; ?>" type="text"
                                                                class="form-control form-control-lg" id="age"
                                                                name="age" />
                                                            <label for="birthdayDate" class="form-label">Age</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6 mb-4">

                                                        <h6 class="mb-2 pb-1">Gender: </h6>

                                                        <div class="form-check form-check-inline">
                                                            <!-- If $gender variable value is "F", echo checked -->
                                                            <input class="form-check-input" type="radio"
                                                                name="inlineRadioOptions" id="femaleGender"
                                                                value="option1"
                                                                <?php if ($gender == "F") echo "checked"; ?> />
                                                            <label class="form-check-label"
                                                                for="femaleGender">Female</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <!-- If $gender variable value is "M", echo checked -->
                                                            <input class="form-check-input" type="radio"
                                                                name="inlineRadioOptions" id="maleGender"
                                                                value="option2"
                                                                <?php if ($gender == "M") echo "checked"; ?> />
                                                            <label class="form-check-label"
                                                                for="maleGender">Male</label>
                                                        </div>

                                                        <div class="form-check form-check-inline">
                                                            <!-- If $gender variable value is "O", echo checked -->
                                                            <input class="form-check-input" type="radio"
                                                                name="inlineRadioOptions" id="otherGender"
                                                                value="option3"
                                                                <?php if ($gender == "O") echo "checked"; ?> />
                                                            <label class="form-check-label"
                                                                for="otherGender">Other</label>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">

                                                        <select class="select form-control-lg" name="class">
                                                            <option value=""><?php echo $class; ?></option>
                                                            <option value="1">Class 1</option>
                                                            <option value="2">Class 2</option>
                                                            <option value="3">Class 3</option>
                                                        </select>
                                                        <label class="form-label select-label">Choose class</label>

                                                    </div>
                                                </div>
                                                <div class="form-group">

                                                    File :
                                                    <input type="file" name="image">
                                                </div>

                                                <div class="mt-4 pt-2">
                                                    <input class="btn btn-primary btn-lg" type="submit" value="Update"
                                                        name="update_student" />
                                                </div>
                                                <!-- Close database connection -->
                                                <?php $conn->close(); ?>
                                                <!-- Close the PHP if statement and while loop -->
                                                <?php
                                                }
                                                }
                                                 ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Include the admin_footer.php file this page from includes folder -->
                    <?php include_once("includes/admin_footer.php"); ?>