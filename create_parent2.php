

<?php
            if (isset($_POST['submit'])) {
              $first_name = $_POST['first_name'];
              $parent_name = $_POST['parent_name'];
              $phone_number = $_POST['phone_number'];
              $occupation = $_POST['occupation'];
            

              
              $sql = "INSERT INTO parent (first_name, parent_name, phone_number, occupation) VALUES ('{$first_name}', '{$parent_name}', '{$phone_number}', '{$occupation}')";

             // $query = mysqli_query($conn, $sql);
             // redirect("display_students.php");

              $conn=new mysqli('localhost',"root","safaricom","user_db");

              
if($conn->query($sql)===TRUE){
    redirect("display_students.php");
    
              
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
    <div class="form-container">
        <form action=""method="post">
    <h3>create parent</h3>
    <?php
    if(isset($error)){
        foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
        };
    };
    ?>

    <input type="text"name="student_name"required placeholder="enter student_name">
    <input type="text"name="parent_name"required placeholder="enter parent_name">
    <input type="text"name="phone_number"required placeholder="enter parent's phone_number">
    <input type="text"name="occupation"required placeholder="enter parent's occupation">
   
   
<input type="submit" name="submit" value="create parent"class="form-btn">

    </form>

    </div>
    
</body>
</html>