<?php
    session_start();
    if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
        header("location: frontpage.php");
        exit;
    }
    if(time()-$_SESSION["login_time_stamp"] >1800)   
    { 
        session_unset(); 
        session_destroy(); 
        header("Location:frontpage.php"); 
    } 
?>
<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['Id'];
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

    $file_name=$name . '.txt';
    if(file_put_contents("$year/$camp/$file_name",get_data())){
        echo '<div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <p>Details added succesfully</p>
            </div>';
    }
     
    else{
        echo 'There is some error';
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
    <link rel="stylesheet" href="assets/css/getdetails.css">
    <link href="assets/css/footer.css" rel="stylesheet">
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
                <th>Id</th>
                <th>Name</th>
                <th>Date of birth</th>
                <th>Class</th>
                <th>School</th>
                <th>Contact</th>
                <th>Camp</th>
                <th>Father's Name</th>
                <th>Father's Occupation</th>
                <th>Mother's Name</th>
                <th>Mother's Occupation</th>
                <th>Update</th>
            </tr>
            <?php
           $year = date("Y");
            $dir_path = "$year/";
            if (is_dir($dir_path)) {
                $files = opendir($dir_path); {
                    if ($files) {
                        while (($file_name = readdir($files)) !== FALSE) {
                            if ($file_name != '.' && $file_name != '..') {
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
            } ?>
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
                            Id<input type="text" id="inpId" name='Id' ><br>
                            Name<input type="text" id="inpname" name='name' ><br>
                            DOB <input type="date" id="inpdob" name='dob'><br>
                            Class<input type="number" id="inpclass" name='class' ><br>
                            School<input type="text" id="inpschool" name='school' ><br>
                            Number<input type="number" id="inpnumber" name="number" ><br>
                            Camp&nbsp;<select id="inpcamp" name='camp' required>
                                <option>Camp</option>
                                <option>Samrat Chowk</option>
                                <option>Sarvoday Nagar	</option>
                                <option>RKGIT</option>
                                <option>Charmurti</option>
                                <option>Fortis</option>
                                <option>Nursery Kids</option>
                                <option>Kaushambi</option>
                                <option>Mari Mata Temple</option>
                                <option>Unnati</option>
                            </select><br>
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
    <?php require 'footer.html'?>
</body>
</html>