<?php
 
    // Connect to database
    $conn = mysqli_connect("localhost","root","safaricom","studentdb");
     
    // mysqli_connect("servername","username","password","database_name")
   /* if(isset($_POST['register'])){ 
        $name=$_POST['name'];
        $student_id=$_POST['student_id'];
          $write =mysqli_query($conn,"INSERT INTO studentdb ( `name`,`student_id`) 
          VALUES ('$name','$student_id')") or die(mysqli_error($conn));
           echo " <script>setTimeout(\"location.href='index.php';\",150);</script>";}*/
    // Get all the categories from category table
    $sql = "SELECT * FROM `student`";
    $all_categories = mysqli_query($conn,$sql);
  
    // The following code checks if the submit button is clicked
    // and inserts the data in the database accordingly
    if(isset($_POST['submit'])){
            $student_id = $_POST['student_id'];
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $occupation = $_POST['occupation'];
        
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert = "INSERT INTO `parent`(`student_id`, `name`, `phone`, `occupation`)
            VALUES ('$student_id','$name','$phone','$occupation')";
          
          // The following code attempts to execute the SQL query
          // if the query executes with no errors
          // a javascript alert message is displayed
          // which says the data is inserted successfully
          if(mysqli_query($conn,$sql_insert))
        {
           echo " <script>setTimeout(\"location.href='display_students.php';\",150);</script>";
           //'<script>alert("Parent added successfully")</script>';
           
        }
    }
?>
  


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register form</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
    * {
        font-family: 'poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        outline: none;
        border: none;
        text-decoration: none;
    }
    .form-container{
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 450px;
        padding-top: 20px;
       
        background: #eee;
    }
    .form-container form{
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 1);
        background: #fff;
        text-align: center;
    }
    .form-container form h3{
        font-size: 30px;
        text-transform: uppercase;
        margin-bottom: 10px;
        color: #333;
    }
    .form-container form input,
    .form-container form select{
        width:100%;
        padding: 10px 15px;
        font-size: 17px;
        margin: 8px 0;
        background: #eee;
    }
    .form-container form select option{
        background: #fff;

    }
    .form-container form .form-btn{
        background: mediumseagreen;
        color: whitesmoke;
        text-transform: capitalize;
        font-size: 20px;
        cursor: pointer;
    }
    .form-container form .form-btn:hover{
        background:mediumseagreen;
        color:#fff;
    }
    .form-container form p{
        margin-top: 10px;
        font-size: 20px;
        color: #333;
    }
    .form-container form p a{
      color: crimson;  
      
    }
    .form-container form .error-msg{
        margin:10px 0;
        display:block;
        background: crimson;
        color: #fff;
        border-radius: 5px;
        font-size: 20px;
    }
    </style>
</head>
<body>
    <!-- parent form -->
    <div class="form-container">
    <form method="POST">
    <h3>ADD PARENT</h3>
    <input type="text" value="<?php echo $student_id; ?>" />
        <input type="text"name="name"required placeholder="enter parent_name">
    <input type="text"name="phone"required placeholder="enter parent's phone_number">
        <input type="text" name="occupation" required placeholder="enter parent's occupation">
    
        <br>
        <input type="submit" value="submit" name="submit" value="create parent"class="form-btn">
    </form>
    <div>
    <br>
</body>
</html>

