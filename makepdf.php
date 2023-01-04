<!--
require_once __DIR__ . '/vendor/autoload.php';
//Grab variables
$id=$_POST['id'];
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
$age=$_POST['age'];
$class=$_POST['class'];
$gender=$_POST['gender'];
$student_image=$_POST['student_image'];

//create new pdf instance
$mpdf = new \Mpdf\Mpdf();

//create new pdf
$data='';
$data.='<h1>details</h1>';
//add data
$data.='<strong>ID</strong>'.$id.'<br/>';
$data.='<strong>First Name</strong>'.$first_name.'<br/>';
$data.='<strong>Last Name</strong>'.$last_name.'<br/>';
$data.='<strong>Age</strong>'.$age.'<br/>';
$data.='<strong>Class</strong>'.$class.'<br/>';
$data.='<strong>Gender</strong>'.$gender.'<br/>';
$data.='<strong>Student Image</strong>'.$Student_image.'<br/>';


//write pdf
$mpdf->WriteHTML($data);

//output to browser
$mpdf->Output('myfile.pdf','D');




?> -->
<?php
//display_students.php
//include autoloader

require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;


$document =new Dompdf();


$connect=mysqli_connect("localhost","root","safaricom","studentdb");
//$output='';
if(isset($_POST["export_Pdf"]))
{
    $sql = "SELECT student_id, first_name, last_name, age, class, gender,student_Image FROM student";
   // $query="SELECT* FROM student ORDER BY id DESC";
$result=mysqli_query($connect,$sql);

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
    $document->loadHtml($output);
    $document->setpaper('A4','landscape');
$document->render();
$document->stream("Weblesson",array("Attachment"=>0)); 
}
?>