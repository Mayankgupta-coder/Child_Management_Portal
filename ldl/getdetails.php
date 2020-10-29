<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: index.php");
        exit;
    }
 
    if(time()-$_SESSION["login_time_stamp"] >1800)   
    { 
        session_unset(); 
        session_destroy(); 
        header("location:index.php"); 
    } 
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id = $_POST['Id'];
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $class = $_POST['class'];
        $school = $_POST['school'];
        $number = $_POST['number'];
        $camp = $_POST['camp'];
        $fathername = $_POST['fatherName'];
        $fatheroccupation = $_POST['fatherOccupation'];
        $mothername = $_POST['motherName'];
        $motheroccupation = $_POST['motherOccupation'];

        $year = date("Y"); 
//      mkdir($year);
//  mkdir("$year/$camp");
    if (!file_exists("$year/$camp")) {
        mkdir("$year/$camp");
    }
    function get_data(){
         $id = $_POST['Id'];
        $name = $_POST['name'];
        $dob = $_POST['dob'];
        $class = $_POST['class'];
        $school = $_POST['school'];
        $number = $_POST['number'];
        $camp = $_POST['camp'];
        $fathername = $_POST['fatherName'];
        $fatheroccupation = $_POST['fatherOccupation'];
        $mothername = $_POST['motherName'];
        $motheroccupation = $_POST['motherOccupation'];
        $year = date("Y");
         $file_name=$name .'_'.$id.'.json';
        
        if(!file_exists("$year/$camp/$file_name"))
        {
            $datae=array();
            $datae[]=array(
                'Id' => $_POST['Id'],
                'Name' => $_POST['name'],
                'class' => $_POST['class'],
                'school' => $_POST['school'],
                'camp' => $_POST['camp'],
                'contact' => $_POST['number'],
                'DOB' => $_POST['dob'],
                'Fathers_Name' => $_POST['fatherName'],
                'Fathers_Occupation' => $_POST['fatherOccupation'],
                'Mothers_Name' => $_POST['motherName'],
                'Mothers_Occupation' => $_POST['motherOccupation']
            );
            return json_encode($datae);
        }
        else
        {
            $current_data=file_get_contents("$year/$camp/$file_name");
                        $array_data=json_decode($current_data,true);
                        $extra=array(
                             'Id' => $_POST['Id'],
                                'Name' => $_POST['name'],
                                'class' => $_POST['class'],
                                'school' => $_POST['school'],
                                'camp' => $_POST['camp'],
                                'contact' => $_POST['number'],
                                'DOB' => $_POST['dob'],
                                'Fathers_Name' => $_POST['fatherName'],
                                'Fathers_Occupation' => $_POST['fatherOccupation'],
                                'Mothers_Name' => $_POST['motherName'],
                                'Mothers_Occupation' => $_POST['motherOccupation']
                            
                        );
                        $array_data[0]=$extra;
//                         echo "file exist<br/>";
                         return json_encode($array_data);
        }
    }

    $file_name=$name .'_'.$id.'.json';
    if(file_put_contents("$year/$camp/$file_name",get_data())){
        echo "<script>alert('Details added succesfully.It will be updated within 5 hours')</script>";
        // echo '<div class="alert alert-success alert-dismissible" role="alert">
        //     <button type="button" class="close" data-dismiss="alert">&times;</button>
        //     <p>Details added succesfully</p>
        //     </div>';
    }
     
    else{
        echo "<script>alert('There is some error')</script>";
        //echo 'There is some error';
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Get Detail</title>
    <title>Welcome-<?php $_SESSION['username']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="details.css">
    <link href="footer.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'header2.html'?>
    <section id='sectionid'>
        <button  id='inpsubmit' name='submit' class="btn btn-dark" onclick='document.location="form2.php"'>Add New Student</button>
        <input type="text" class="btn btn-light" id="inpsearch" placeholder="SEARCH" /><br>
        <div class="container-fluid">       
            <h1>Student Details</h1>                 
        <table id='tbltable' class="table table-bordered">
            <tr class="text-light">
                  <th class="tdId">Id</th>
                <th class="tdname">Name</th>
                <th class="tdDOB">Date of birth</th>
                <th class="tdclass">Class</th>
                <th class="tdschool">School</th>
                <th class="tdcontact">Contact</th>
                <th class="tdcamp">Camp</th>
                <th class="tdfather">Father's Name</th>
                <th class="tdfatheroccupation">Father's Occupation</th>
                <th class="tdmother">Mother's Name</th>
                <th class="tdmotheroccupation">Mother's Occupation</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            <?php
           $year = date("Y");
           $file_name=$_SESSION["entercamp"];
           if($file_name!='All Camps')
           {
            $dir_path = "$year/";
            if (is_dir($dir_path)) {
                $files = opendir($dir_path); {
                    if ($files) {
                        $file_name=$_SESSION["entercamp"];
                       
                            if ($file_name != '.'  ) {
                                $dirpath = "$year/" . $file_name . "/";
                                if (is_dir($dirpath)) {
                                    $file = opendir($dirpath); {
                                        if ($file) {
                                            while (($filename = readdir($file)) !== FALSE) {
                                                if ($filename != '.' && $filename != '..') {
            ?>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $.getJSON("<?php echo "$year/" . $file_name . "/" . $filename; ?>", function(data) {
                                                                var student = '';
                                                                $.each(data, function(key, value) {
                                                                    student+='<tbody id="tbltbody">';
                                                                    student += '<tr>';
                                                                    if(value.Name)
                                                                        {
                                                                            student += '<td class="tdId">' + value.Id + '</td>';
                                                                    student += '<td class="tdname">' + value.Name + '</td>';
                                                                    student += '<td class="tdDOB">' + value.DOB + '</td>';
                                                                    student += '<td class="tdclass">' + value.class + '</td>';
                                                                    student += '<td class="tdschool">' + value.school + '</td>';
                                                                    student += '<td class="tdcontact">' + value.contact + '</td>';
                                                                    student += '<td class="tdcamp">' + value.camp + '</td>';
                                                                    student += '<td class="tdfather">' + value.Fathers_Name + '</td>';
                                                                    student += '<td class="tdfatheroccupation">' + value.Fathers_Occupation + '</td>';
                                                                    student += '<td class="tdmother">' + value.Mothers_Name + '</td>';
                                                                    student += '<td class="tdmotheroccupation">' + value.Mothers_Occupation + '</td>';
                                                                    student += '<td><button type="button" class="tdupdate bg-secondary" data-toggle="modal" data-target="#divModal">Update</button></td>';
                                                                    student += '<td><button type="button" class="tddelete bg-secondary" data-toggle="modal" data-target="#divModal">Delete</button></td>';
                                                                        }
                                                                    
                                                                    student += '</tbody>';
                                                                    student += '</tr>';
                                                                });
                                                                $('#tbltable').append(student);
                                                                if(window.navigator.userAgent.indexOf("Mobile") > -1){
                                                                     $(".tdDOB").hide(); $(".tdclass").hide();$(".tdcontact").hide(); $(".tdschool").hide(); $(".tdmotheroccupation").hide(); $(".tdmother").hide();$(".tdfather").hide();$(".tdfatheroccupation").hide(); console.log("it is mobile");}
                                                                else{
                                                                    console.log("it is desktop")};
    $(function () {
        $(".tdupdate").click(function() {
            var a = $(this).parents("tr").find(".tdname").text();
            var b = $(this).parents("tr").find(".tdId").text();
            var c = $(this).parents("tr").find(".tdDOB").text();
            var d = $(this).parents("tr").find(".tdclass").text();
            var e = $(this).parents("tr").find(".tdschool").text();
            var f = $(this).parents("tr").find(".tdcontact").text();
            var g = $(this).parents("tr").find(".tdcamp").text();
            var h = $(this).parents("tr").find(".tdfather").text();
            var i = $(this).parents("tr").find(".tdfatheroccupation").text();
            var j = $(this).parents("tr").find(".tdmother").text();
            var k = $(this).parents("tr").find(".tdmotheroccupation").text();
            
            $("#inpname").val(a);
            $("#inpId").val(b);
            $("#inpdob").val(c);
            $("#inpclass").val(d);
            $("#inpschool").val(e);
            $("#inpnumber").val(f);
            $("#inpcamp").val(g);
            $("#inpfatherName").val(h);
            $("#inpfatherOccupation").val(i);
            $("#inpmotherName").val(j);
            $("#inpmotherOccupation").val(k);
        })
    })
    
                                                            });
                                                        });
                                                    </script>
            <?php }
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
                }
            } 
        }
        if($file_name=='All Camps')
        {
            $dir_path = "$year/";
            if (is_dir($dir_path)) {
                $files = opendir($dir_path); {
                    if ($files) {
                        while (($file_name = readdir($files)) !== FALSE) {
                            if ($file_name != '.' && $file_name != '..') {
                        
                            if ($file_name != '.'  ) {
                                $dirpath = "$year/" . $file_name . "/";
                                if (is_dir($dirpath)) {
                                    $file = opendir($dirpath); {
                                        if ($file) {
                                            while (($filename = readdir($file)) !== FALSE) {
                                                if ($filename != '.' && $filename != '..') {
            ?>
                                                    <script>
                                                        $(document).ready(function() {
                                                            $.getJSON("<?php echo "$year/" . $file_name . "/" . $filename; ?>", function(data) {
                                                                var student = '';
                                                                $.each(data, function(key, value) {
                                                                    student+='<tbody id="tbltbody">';
                                                                    student += '<tr>';
                                                                    if(value.Name)
                                                                        {
                                                                            student += '<td class="tdId">' + value.Id + '</td>';
                                                                    student += '<td class="tdname">' + value.Name + '</td>';
                                                                    student += '<td class="tdDOB">' + value.DOB + '</td>';
                                                                    student += '<td class="tdclass">' + value.class + '</td>';
                                                                    student += '<td class="tdschool">' + value.school + '</td>';
                                                                    student += '<td class="tdcontact">' + value.contact + '</td>';
                                                                    student += '<td class="tdcamp">' + value.camp + '</td>';
                                                                    student += '<td class="tdfather">' + value.Fathers_Name + '</td>';
                                                                    student += '<td class="tdfatheroccupation">' + value.Fathers_Occupation + '</td>';
                                                                    student += '<td class="tdmother">' + value.Mothers_Name + '</td>';
                                                                    student += '<td class="tdmotheroccupation">' + value.Mothers_Occupation + '</td>';
                                                                    student += '<td><button type="button" class="tdupdate bg-secondary" data-toggle="modal" data-target="#divModal">Update</button></td>';
                                                                    student += '<td><button type="button" class="tddelete bg-secondary" data-toggle="modal" data-target="#divdelModal">Delete</button></td>';
                                                                        }
                                                                    
                                                                    student += '</tbody>';
                                                                    student += '</tr>';
                                                                });
                                                                $('#tbltable').append(student);
                                                                if(window.navigator.userAgent.indexOf("Mobile") > -1){
                                                                     $(".tdDOB").hide(); $(".tdclass").hide();$(".tdcontact").hide(); $(".tdschool").hide(); $(".tdmotheroccupation").hide(); $(".tdmother").hide();$(".tdfather").hide();$(".tdfatheroccupation").hide(); console.log("it is mobile");}
                                                                else{
                                                                    console.log("it is desktop")};
    $(function () {
        $(".tdupdate").click(function() {
            var a = $(this).parents("tr").find(".tdname").text();
            var b = $(this).parents("tr").find(".tdId").text();
            var c = $(this).parents("tr").find(".tdDOB").text();
            var d = $(this).parents("tr").find(".tdclass").text();
            var e = $(this).parents("tr").find(".tdschool").text();
            var f = $(this).parents("tr").find(".tdcontact").text();
            var g = $(this).parents("tr").find(".tdcamp").text();
            var h = $(this).parents("tr").find(".tdfather").text();
            var i = $(this).parents("tr").find(".tdfatheroccupation").text();
            var j = $(this).parents("tr").find(".tdmother").text();
            var k = $(this).parents("tr").find(".tdmotheroccupation").text();
            
            $("#inpname").val(a);
            $("#inpId").val(b);
            $("#inpdob").val(c);
            $("#inpclass").val(d);
            $("#inpschool").val(e);
            $("#inpnumber").val(f);
            $("#inpcamp").val(g);
            $("#inpfatherName").val(h);
            $("#inpfatherOccupation").val(i);
            $("#inpmotherName").val(j);
            $("#inpmotherOccupation").val(k);
        })
    })
    $(function () {
        $(".tddelete").click(function() {
            var a = $(this).parents("tr").find(".tdname").text();
            var b = $(this).parents("tr").find(".tdId").text();
            var c = $(this).parents("tr").find(".tdDOB").text();
            var d = $(this).parents("tr").find(".tdclass").text();
            var e = $(this).parents("tr").find(".tdschool").text();
            var f = $(this).parents("tr").find(".tdcontact").text();
            var g = $(this).parents("tr").find(".tdcamp").text();
            var h = $(this).parents("tr").find(".tdfather").text();
            var i = $(this).parents("tr").find(".tdfatheroccupation").text();
            var j = $(this).parents("tr").find(".tdmother").text();
            var k = $(this).parents("tr").find(".tdmotheroccupation").text();
            
            $("#inpdelname").val(a);
            $("#inpdelId").val(b);
            $("#inpdelcamp").val(g);
            
        })
    })
    
   
                                                            });
                                                        });
                                                    </script>
            <?php }
                                            }
                                        }
                                    }
                                }
                            }
                        
                    }
                }
            }
        }
            } 
        }
        
        ?>
        
            </table>
            
    </section>
    <script>
       $(document).ready(function() { 
                $("#inpsearch").on("keyup", function() { 
                    var value = $(this).val().toLowerCase(); 
                    $("#tbltbody tr").filter(function() { 
                        $(this).toggle($(this).text() 
                        .toLowerCase().indexOf(value) > -1) 
                    }); 
                }); 
            }); 

            
    </script>

    <div class="modal fade" id="divModal" tabindex="-1" role="dialog" aria-labelledby="hmodaltitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="hmodaltitle">UPDATE</h2>
                </div>
                <div class="modal-body">
                    <div class="contact-form">
                        <form method="post" action="getdetails.php">
                            Id<input type="text" id="inpId" name='Id' readonly><br>
                            Name<input type="text" id="inpname" name='name' readonly><br>
                            DOB <input type="date" id="inpdob" name='dob'><br>
                            Class<input type="number" id="inpclass" name='class' ><br>
                            School<input type="text" id="inpschool" name='school' ><br>
                            Number<input type="number" id="inpnumber" name="number" ><br>
                            Camp<input id="inpcamp" name='camp' readonly><br>
                            Father's Name<input type="text" id="inpfatherName" name="fatherName" required><br>
                            Occupation<input type="text" id="inpfatherOccupation" name="fatherOccupation" required><br>
                            Mother's Name<input type="text" id="inpmotherName" name="motherName" required><br>
                            Occupation<input type="text" id="inpmotherOccupation" name="motherOccupation" required><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" onclick='document.location="getdetails.php"'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="divdelModal" tabindex="-1" role="dialog" aria-labelledby="hmodaltitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="hmodaltitle">DELETE</h2>
                </div>
                <div class="modal-body">
                    <div class="contact-form">
                        <form method="post" action="delete.php">
                            Id<input type="text" id="inpdelId" name='Id' readonly><br>
                            Name<input type="text" id="inpdelname" name='name' readonly><br>
                            Camp<input id="inpdelcamp" name='camp' readonly><br>
                        
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="submit" onclick='document.location="getdetails.php"'>Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.html'?>
</body>
</html>
