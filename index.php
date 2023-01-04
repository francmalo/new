
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
          <div class="col-md-12">



         

<!--
            php
            // Check if the form submit button has been given the 'create_student' name
            if (isset($_POST['create_student'])) {
              // Assign the form's input values to PHP variables
              $first_name = $_POST['first_name'];
              $last_name = $_POST['last_name'];
              $age = (int)$_POST['age'];
              $class = "Class " . $_POST['class'];
              $gender_type = $_POST['inlineRadioOptions'];

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
                  $image = $_FILES['file'];
              }

              
                

              // MySQL query to be made to the database in order to insert values into the database
              $sql = "INSERT INTO student (first_name, last_name, age, class, gender) VALUES ('{$first_name}', '{$last_name}', '{$age}', '{$class}', '{$gender}')";

              // Make connection to the MySQL database using connection details ($conn) and the MySQL query ($sql)
              $query = mysqli_query($conn, $sql);
              // Redirect to display_students.php after successfully inserting students details into the database
              redirect("display_students.php");

              // Close MySQL connection
              $conn->close();
            }
            ?
-->





<?php
    //define variables and set to empty
    $first_nameErr=$last_nameErr=$ageErr=$class=$gender=NULL;
    $first_name=$last_name=$age=$class=$gender=NULL;

$flag=true;
    if($_SERVER["REQUEST_METHOD"]=="POST")    {

        if(empty($_POST["first_name"])){
            $first_nameErr="*first name is required";
            $flag=false;
           }
           else {
            $first_name=test_input($_POST["first_name"]);

           }


        if(empty($_POST["last_name"])){
            $last_nameErr="*last name is required ";
            $flag=false;
           }
           else {
            $last_name=test_input($_POST["last_name"]); 

           }

           //$age = (int)$_POST['age'];
    
        if(empty($_POST["age"])){
            $ageErr="*please enter a valid age";
            $flag=false;
           }
           else {
           $age=test_input($_POST["age"]);
           }



           $class = "Class " . $_POST['class'];
          // if(isset($_REQUEST['select_class']) && $_REQUEST['select_class'] == '0') { 
           // echo 'Please select class .'; 
         //} 

$gender_type = $_POST['inlineRadioOptions'];

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


              if(isset($_FILES['upload'])) 
	{ 
		// file name, type, size, temporary name 
		$file_name = $_FILES['upload']['name']; 
		$file_type = $_FILES['upload']['type']; 
		$file_tmp_name = $_FILES['upload']['tmp_name']; 
		$file_size = $_FILES['upload']['size']; 

// target directory 
		$target_dir = "uploads/"; 
  }
	 
		// uploding file 
		if(move_uploaded_file($file_tmp_name,$target_dir.$file_name)) 
		 
			// connect to database 
			//$cdb = mysqli_connect('localhost','root','safaricom','studentdb') or die("Sorry could not connect to database"); 
			 
			// query 
		//	$q = 'INSERT INTO student(images) VALUES("'.$target_dir.$file_name.'")'; 
			 
			// run query 
			//$r = mysqli_query($cdb,$q); 
			 
			//if(mysqli_affected_rows($cdb) == 1) 
			//{ 
				//echo "<p style='color:green'><b>File has been successfully uploaded</b></p>"; 
			//} 
			//else 
			//{ 
			//echo "<p>A system error has been occured</p>".mysqli_error($cdb); 
			//} 
		//} 
		//else 
		//{ 
			//echo "File can not be uploaded"; 
		//} 
	//} 
//} 


//submit form if validated successfully
if ($flag){
  $sql = "INSERT INTO student ( student_image,first_name, last_name, age, class, gender) VALUES 
  ('{$file_name}','{$first_name}', '{$last_name}', '{$age}', '{$class}', '{$gender}')";

$conn=new mysqli('localhost',"root","safaricom","studentdb");

if($conn->query($sql)===TRUE){
  redirect("display_students.php");
  
}



}

    
}
    
    function test_input($data){
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
      }


    ?>



          </div>

          <section style="width: 100%;" class="gradient-custom">
            <div class="container h-60">
              <div class="row justify-content-center align-items-center h-50">
                <div class="col-12 col-lg-9 col-xl-7">
                  <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
                    <div class="card-body p-4 p-md-5">
                      <style type="text/css">
                        .error{
                          font-size: 15px;
                          color: red;
                        }
                        </style>
                      <h3 class="mb-2 pb-2 pb-md-0 mb-md-2">Registration Form</h3>


                      
                      <form action=" <?php  echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST"  enctype="multipart/form-data">

                        <div class="row">
                          <div class="col-md-6 mb-4">

                            <div class="form-outline">
                            <label class="form-label" for="firstName">First Name</label>
                              <input type="text" id="first_name" class="form-control form-control-lg" name="first_name" />
                              <span class="error"><?=$first_nameErr;?></span>
                              
                              
                            </div>

                          </div>
                          <div class="col-md-6 mb-4">

                            <div class="form-outline">
                            <label class="form-label" for="lastName">Last Name</label>
                              <input type="text" id="last_name" class="form-control form-control-lg" name="last_name" />
                              <span class="error"><?=$last_nameErr;?></span>
                             
                            </div>

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 mb-4 d-flex align-items-center">

                            <div class="form-outline datepicker w-100">
                            <label for="birthdayDate" class="form-label">Age</label>
                              <input type="text" class="form-control form-control-lg" id="age" name="age" />
                              <span class="error"><?=$ageErr;?></span>
                              
                             
                              
                            </div>

                          </div>
                          <div class="col-md-6 mb-4">

                            <h6 class="mb-2 pb-1">Gender: </h6>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="femaleGender" value="option1" checked />
                              <label class="form-check-label" for="femaleGender">Female</label>
                            </div>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="maleGender" value="option2" />
                              <label class="form-check-label" for="maleGender">Male</label>
                            </div>

                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otherGender" value="option3" />
                              <label class="form-check-label" for="otherGender">Other</label>
                            </div>
                           

                          </div>
                        </div>

                        <div class="row">
                          <div class="col-12">

                            <select class="select form-control-lg" name="class">
                            <option value="0">Please Select</option>
                            <option value="1">Class 1</option>
                              <option value="2">Class 2</option>
                              <option value="3">Class 3</option>
                            </select>
                            <label class="form-label select-label">Choose option</label>

                          </div>
                        </div>

                        <!--<div class="row">
                        <div class="col-md-6 mb-4 mt-4">
                        <label class="form-label" for="customFile">profile picture </label>
<input type="file"  name="image" class="form-control" id="image" />
                        </div>
                        </div>
                        < inputfields("","file","","file")?> -->
                        <div class="form-group">
                
                File : <input type="file" name="upload"> 
            </div>

                        <div class="mt-4 pt-2">
                          <input class="btn btn-primary btn-lg" type="submit" value="Submit" name="create_student" />
                        </div>



                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>

          <!-- Include the admin_footer.php file this page from includes folder -->
          <?php include_once("includes/admin_footer.php"); ?>