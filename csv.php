<?php
if(isset($_POST["export_csv"]))
{
    $connect=mysqli_connect("localhost","root","safaricom","studentdb");
    header("Content-Type:text/csv;charset=utf-8");
    header("Content-Disposition:attachment;filename=data.csv");
$output=fopen("php://output","w");
fputcsv($output,array('Student Id','First Name','Last Name','Age','Class','Gender','Student Image'));
$query="SELECT* FROM student ORDER BY student_id DESC";
$result=mysqli_query($connect,$query);
while($row=mysqli_fetch_assoc($result))
{
    fputcsv($output,$row);

}
fclose($output);
}

?>