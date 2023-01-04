

<?php
@include 'config3.php';
session_start();

if(!isset($_SESSION['admin_name'])){
    header('location:login_form.php');
}
?>



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
                    delete_student($id, "display_students.php");
                    break;

                default:
                    # code...
                    break;
            }
        }
        ?>


    
<html>   

  <head>   

    <title>Pagination in PHP</title>   

   <link rel="stylesheet"  

    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 

   

   <style>   

    table {  

        border-collapse: collapse;  

    }  

        .inline{   

            display: inline-block;   

            float: right;   
 
            margin: 20px 0px;   

        }            

        input, button{   

            height: 34px;   

        }    

    .items {   

        display: inline-block;   

    }   

    .items a {   

        font-weight:bold;   

        font-size:18px;   

        color: black;   

        float: left;   

        padding: 8px 16px;   

        text-decoration: none;   

        border:1px solid black;  

        margin: 2px; 

    }   

    .items a.active {   

            background-color: rgba(175, 201, 244, 0.97);   

    }   

    .items a:hover:not(.active) {   

        background-color: #87ceeb;   

    }   

        </style>

  </head> 

  <body>   
 
  <!--<center>-->  

    <?php      

        // Connect to the database

        $conn = mysqli_connect('localhost', 'root', 'safaricom','studentdb');  

        if (! $conn) {  

            die("Connection failed" . mysqli_connect_error());  

            }  

                else {  

            mysqli_select_db($conn, 'studentdb');  

        }       

        // variable to store number of rows per page

        $limit = 3;    

        // update the active page number

        if (isset($_GET["page"])) {    

            $page_number  = $_GET["page"];    

        }    

        else {    

          $page_number=1;    

        }       

        // get the initial page number

        $initial_page = ($page_number-1) * $limit;       

        // get data of selected rows per page 

       // $getQuery = "SELECT * FROM students LIMIT $initial_page, $limit";   
        $sql = "SELECT student_id, first_name, last_name, age, class, gender,student_Image FROM student LIMIT $initial_page, $limit";
        // 
        $query = mysqli_query($conn, $sql);
        $result = mysqli_query ($conn, $sql);    

    ?>     
 
        
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
                                <h4 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["admin_name"]); ?></b>. Welcome to our site.</h4>
   
                                    <h3>STUDENTS</h3>
                                   
    
                                    
                                    
                                            


<div class="row">
    <div>
	<form action="searchdb.php" method="post">
		<input
			type="text"
			placeholder="Enter your search term"
			name="search"
			required
            >
		<button type="submit" name="submit" class="btn btn-primary">Search</button>

        
    </form>
    </div>
 
 <div class="span6">
 <div class="col-md-6 mb-4">
                                    
                                     <form action="" method="post"  >
                                         <input type="submit" name="export_excel" class="btn btn-success" value="Export to Excel" /> 
      </form> </div></div>
                               
                               <div class="span6">   
                               <div class="col-md-6 mb-4">
                                   <form action="csv.php" method="post" >
                                     <input type="submit" name="export_csv" class="btn btn-warning" value="Export to CSV" /> 
     </form>
                               </div></div>
                               <div class="span6"> 
                               <div class="col-md-6 mb-4">
                                            
                                             <form action="makepdf.php" method="post">
                                             <input type="submit" name="export_Pdf" class="btn btn-secondary" value="Export to PDF"/> 
                                         </form>  
                               </div>
     </div></div>
   






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
                                                <th>Parent</th>



            </tr>   

          </thead>   

          <tbody>   

    <?php     

            while ($row = mysqli_fetch_array($result)) {    

                  // Table head
                  $student_id = $row['student_id'];
                  $first_name = $row['first_name'];
                   $last_name = $row['last_name'];
                  $age = $row['age'];
                  $class = $row['class'];
                  $gender = $row['gender'];

            ?>     

            <tr style="cursor: pointer;" >     
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
                                                    <td class="text-center"><a href="edit_student.php?action=update&student_id=<?php echo $student_id; ?>" class="btn btn-primary btn-sm">Edit</a></td>
                                                    <!-- Add query string with fields action having value 'delete' & id having value $id from a php variable -->
                                                    <td class="text-center"><a href="display_students.php?action=delete&student_id=<?php echo $student_id; ?>" class="btn btn-danger btn-sm" button onclick="return confirm('Are you sure you want to Delete?');" >Delete </a></td>

                                                 
                                                    <td class="text-center"><a href="student_details.php?action=details&student_id=<?php echo $student_id; ?>" class="btn btn-info btn-sm">Details</a></td>
                                            
                                                    <td class="text-center"><a href="parent2.php?action=parent&student_id=<?php echo $student_id; ?>" class="btn btn-success btn-sm">Parent</a></td>
                                            


            </tr>     

            <?php     

                };    

            ?>     

          </tbody>   

        </table>   
         
       

     <div class="Items">    

      <?php  

        //$getQuery = "SELECT COUNT(*) FROM student";   
        $sql = "SELECT student_id, first_name, last_name, age, class, gender,student_Image FROM student ";
        $query = mysqli_query($conn, $sql);

        $result = mysqli_query($conn, $sql);     

        $row = mysqli_fetch_row($result);     

        $total_rows = $row[0];              

    echo "</br>";            

        // get the required number of pages

        $total_pages = ceil($total_rows / $limit);     

        $pageURL = "";             

        if($page_number>=2){   

            echo "<a href='display_students.php?page=".($page_number-1)."'>  Prev </a>";   

        }                          

        for ($i=1; $i<=$total_pages; $i++) {   

          if ($i == $page_number) {   

              $pageURL .= "<a class = 'active' href='display_students.php?page="  

                                                .$i."'>".$i." </a>";   

          }               

          else  {   

              $pageURL .= "<a href='display_students.php?page=".$i."'>   

                                                ".$i." </a>";     

          }   

        };     

        echo $pageURL;    

        if($page_number<$total_pages){   

            echo "<a href='display_students.php?page=".($page_number+1)."'>  Next </a>";   

        }     

      ?>    

      </div>    

      <div class="inline">   

      <input id="page" type="number" min="1" max="<?php echo $total_pages?>"   

      placeholder="<?php echo $page_number."/".$total_pages; ?>" required>   

      <button onClick="go2Page();">Go</button>   

     </div>    

    </div>   

  </div>  

</center>  

  <script>   

    function go2Page()   

    {   

        var page = document.getElementById("page").value;   

        page = ((page><?php echo $total_pages; ?>)?<?php echo $total_pages; ?>:((page<1)?1:page));   

        window.location.href = 'display_students.php?page='+page;   

    }   

  </script>  
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

  </body>   

</html>  
         
</div>
                            </div>
                        </div>
                    
                    </div>
                   
                    <?php include_once("includes/admin_footer.php"); ?>
                    

