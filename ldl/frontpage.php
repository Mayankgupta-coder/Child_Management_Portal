<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user='lightdeliteracy';
        $pass='12345678';
        if($username==$user && $password==$pass)
        {
            $login = true;
           
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;
             $_SESSION["login_time_stamp"] = time();   
            header("location: getdetails.php");
        }
        else
        echo "<p>Wrong username or password. Try Again</p>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Get Details</title>
    <link href="assets/css/footer.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/frontpage.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
</head>
    <body>
        <!--Create Nav bar-->
        <?php require 'header.html'?>

        <!--Login to Update/View-->
        <div class="modal fade" id="divModal" tabindex="-1" role="dialog" aria-labelledby="hmodaltitle" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="hmodaltitle">Login to Update/View</h5>
                    </div>
                    <div class="modal-body">
                        <div class="contact-form">                
                            <form method="post" action="frontpage.php" autocomplete="off">
                                <input type="text" name="username" placeholder="Enter username" required autocomplete="off">
                                <input type="password" name="password" placeholder="Enter Password" required autocomplete="off">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="login">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Searchbar -->
        <div class="searchBox">              
            <input type="text" id="inpsearch" placeholder="SEARCH" class="btn btn-light">                         
            <input type="submit" value="Search" id="search" class="btn btn-dark">             
        </div>
        
        <!-- Table -->
        <div class="container-fluid">       
            <h1>Student Details</h1>                 
            <table id='tbltable' class="table-responsive-xl table table-bordered table-hover">
                <thead>
                    <tr class="text-uppercase">
                        <th>Student's Name</th>
                        <th>Camp</th>
                    </tr>
                </thead>
                    <tbody>
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
                                                                            student += '<td class="tdname">' + value.Name + '</td>';
                                                                            student += '<td class="tdcamp">' + value.camp + '</td>';
                                                                            student += '</tbody>';
                                                                            student += '</tr>';
                                                                        });
                                                                        $('#tbltable').append(student);
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
                    </tbody>
            </table>      
        </div>
    
        <?php require 'footer.html'?>
        <script>            
                $(document).ready(function() { 
                    $("#inpsearch").on("keyup", function() { 
                        var value = $(this).val().toLowerCase(); 
                        $("#tbltbody tr").filter(function() { 
                            $(this).toggle(
                                $(this).text() 
                                .toLowerCase().indexOf(value) > -1) 
                        }); 
                    }); 
                }); 
        </script>
    </body>    
</html>
