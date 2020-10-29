<?php 
// PHP program to delete a file named gfg.txt  
// using unlike() function  
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['Id'];
    $name = $_POST['name'];
    $camp = $_POST['camp'];
    $year = date("Y"); 
$file_pointer =$name .'_'.$id.'.json';
   
// Use unlink() function to delete a file  
if (!unlink("$year/$camp/$file_pointer")) {  
    echo ("$file_pointer cannot be deleted due to an error");  
}  
else {  
    echo ("$file_pointer has been deleted");  
} 
header("location:getdetails.php"); 
}
?>  
