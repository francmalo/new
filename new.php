
<!-- Include the admin_header.php file to this page -->
<?php include_once("includes/admin_header.php"); ?>

<body id="page-top">

    <!-- Include admin_top_navigation.php file from includes folder -->
    <?php include_once("includes/admin_top_navigation.php"); ?>

    <div id="wrapper">

        <!-- Include the admin_sidebar_nav.php file to this home file -->
        <?php include_once("includes/admin_sidebar_nav.php"); ?>


        <?php
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            $student_id     = $_GET['student_id'];

            switch ($action) {
                case 'delete':
                    delete_student($student_id, "display_students.php");
                    break;

                default:
                    # code...
                    break;
            }
        }
        ?>
        



        <!--
        // Check if the url has query strings 'action' and 'id' fields
        if (isset($_GET['action'])) {
            // If yes, assign it the php variable $action
            $action = $_GET['action'];
            // And then assign the id value to the php variable $id
            $id  = $_GET['id'];
            // Switch $action variable performing necessary actions
            switch ($action) {
                case 'delete':
                    // This delete_student() function is defined in the '../functions.php' file
                    delete_student($id, "display_students.php");
                    // Prevent this case block from executing if not found
                    break;

                default:
                    # code...
                    break;
            }
        }
        ?>-->
   


       <!-- <php
        $connect=mysqli_connect("localhost","root","safaricom","studentdb");
        $query="SELECT* FROM student ORDER BY id DESC";
        $result=mysqli_query($connect,$query);
       
    ?> -->
 
      
      

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
                                <div class="col-md-12">
                                    <h3>STUDENTS</h3>

<main>
	<form action="searchdb.php" method="post">
		<input
			type="text"
			placeholder="Enter your search term"
			name="search"
			required
            >
		<button type="submit" name="submit" class="btn btn-primary">Search</button>
       
    </form>
</main>






                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <form  action="excel.php" method="POST" enctype="multipart/form-data">
                                    
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
                                           
                                            <?php
                                            
                                        


                                            // MySQL query to be made to the database in order to select values id, first_name, last_name, age, class and gender from the database
                                            $sql = "SELECT student_id, first_name, last_name, age, class, gender,student_Image FROM student ";
                                            // Make connection to the MySQL database using connection details ($conn) and the MySQL query ($sql)
                                           $query = mysqli_query($conn, $sql);
                                           $result = mysqli_query($conn, $sql);
                                          // for( $i=0;$i<count($results->data);$i++)
                                            // While row is true, store its value in the respective php variables
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $student_id = $row['student_id'];
                                                $first_name = $row['first_name'];
                                                 $last_name = $row['last_name'];
                                                $age = $row['age'];
                                                $class = $row['class'];
                                                $gender = $row['gender'];
                                                
                                                // $image = $row['image'];-->
                                                 
                                               
                                            ?>
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
                                                    <td> <img src="uploads/<?php echo $row['student_Image'];?>" width="100px" h
                                                    eight="100px"></td>
      
                                                       
                                                    <!-- Add query string with fields action having value 'update' & id having value $id from a php variable -->
                                                    <td class="text-center"><a href="edit_student.php?action=update&id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                                    <!-- Add query string with fields action having value 'delete' & id having value $id from a php variable -->
                                                    <td class="text-center"><a href="display_students.php?action=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm" button onclick="return confirm('Are you sure you want to Delete?');" >Delete </a></td>

                                                 
                                                   


                                                
                                                    <td class="text-center"><a href="student_details.php?action=details&id=<?php echo $id; ?>" class="btn btn-info btn-sm">Details</a></td>
                                                </tr>
                                            <?php } 
                                            ?>
                                            <!-- End while loop -->
                                        </tbody>
                                       
                                    </table>
                                 
                    
                                   <tr>
                                  <td>  <form action="" method="post">
                                        <input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel" /> 
                                            </form>
                                           </td>
                                            <br>
                                           <td> <form action="csv.php" method="post">
                                    <input type="submit" name="export_csv" class="btn btn-warning"value="Export to CSV" /> 
                                            </form></td>
                                            <br>
                                            <td><form action="makepdf.php" method="post">
                                            <input type="submit" name="export_Pdf" class="btn btn-secondary" value="Export to PDF"/> 
                                        </form></td>    
                                        </td>
                                            </tr>
                                           
                                    </div>
                            </div>
                        </div>
                    
                    </div>
                   
                    <?php include_once("includes/admin_footer.php"); ?>
                    