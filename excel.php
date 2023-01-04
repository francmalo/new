<?php
$connect=mysqli_connect("localhost","root","safaricom","studentdb");
$output='';
if(isset($_POST["export_excel"]))
{
$query="SELECT* FROM student ORDER BY id DESC";
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)>0)
{
    $output.='
    <table class="table" bordered="1">
    <tr>
    <th>Student Id</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Age</th>
    <th>Class</th>
    <th>Gender</th>
    <th>Student Image</th>
    </tr>
    ';
    while($row=mysqli_fetch_array($result))
    {
         $output.='
         <tr>
         <td>'.$row["student_id"].'</td>
         <td>'.$row["first_name"].'</td>
         <td>'.$row["last_name"].'</td>
         <td>'.$row["age"].'</td>
         <td>'.$row["class"].'</td>
         <td>'.$row["gender"].'</td>
         <td>'.$row["student_image"].'</td>
         </tr>
         ';
    }
    $output.='</table>';
    header("Content-Type:application/xls");
    header("Content-Disposition:attachment;filename=download.xls");
    echo $output;
    
}
}
?>