<script>
    let name=sessionStorage.getItem('officer_name');
      switch (name)
      {
         case null:
            location.href="index.php"
           break;
         case undefined:
            location.href="index.php"
            break;
      }
 </script>


<?php
    include_once('resources/include.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EKIRS LUC</title>
    <link rel="shortcut icon" href="image/ekirs.ico">
    
    <link rel="stylesheet" href="resources/customCss/dashboard.css">
    <script src="resources/customJs/dashboard.js"></script>


</head>
<body>
    <div>
        <div class="row motherContainer">
            <!-- including sidenav -->
             <?php require __DIR__.'/resources/sidenav/sidenav.php' ?>
            <!--sidenav  ends here -->
            <div class="col-lg-10 secondCol bg-light">
                <!-- topnav -->
                <?php require __DIR__.'/resources/topnav/topnav.php' ?>
                <!--top nav ends here -->
                   <div class="section2Container">
                      
                       <div class='hasChildren'>
                     

                            <div class="row mb-5">
                                
                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="add_file2">
                                   <i class="fas fa-chart-line fa-4x text-danger"></i>
                                   <h5 class="text-center">Add Files</h5>
                                </div>
                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="send_file2">
                                    <i class="fas fa-print fa-4x"></i>
                                   <h5 class="text-center">Send Files</h5>
                                </div>
                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="track_file2">
                                   <i class="fas fa-search fa-4x text-danger"></i>
                                   <h5 class="text-center">Track Files</h5>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="accept_file2">
                                   <i class="fas fa-file fa-4x text-primary"></i>
                                   <h5 class="text-center">Accept Files</h5>
                                </div>
                                
                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="usersManagement2">
                                   <i class="fas fa-fill fa-4x text-secondary"></i>
                                   <h5 class="text-center">users Management</h5>
                                </div>
                                <div class="col-lg-3 itemMother text-center bg-light shadow" id="dashboard2">
                                    <i class="fas fa-tachometer-alt fa-4x text-success"></i>
                                   <h5 class="text-center">Dashboard</h5>
                                </div>
                            </div>
                        </div>
            </div>
          
        </div>
      
    </div>
</body>
</html>