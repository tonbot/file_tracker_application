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
    
    <link rel="stylesheet" href="resources/customCss/add_users.css">
    <script src="resources/customJs/add_files.js"></script>


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
                   <div class="section2">
                      
                       <div class='hasChildren'>
                       <div class="SearchTitle"><span>Add Files</span</div>

                       <div class="frmContainer"> <!-- row container -->
                       <form  method="POST">
                                <div class="container2">
                                   <div id="add_user_message" class="text-center" >  </div>
                                   <div><label for="">File No</label></div>
                                   <div><input class="form-control" type="text" name="file_no" id="file_no" placeholder="Please enter file number" required></div>
                                   <div><label for="">Beneficiary</label></div>
                                   <div><input class="form-control" type="text" name="beneficiary" id="beneficiary" placeholder="Please enter beneficiary" required ></div>
                                   <div><label for="">Amount</label></div>
                                   <div><input class="form-control" type="number" name="amount" id="amount" placeholder="Please enter amount" required></div>
                                   <div><label for="">File Description</label></div>
                                   <div><input class="form-control" type="text" name="file_desc" id="file_desc" placeholder="Please enter file description" required></div>
                                </div>              
                           <div class="text-center pt-5 "><button id="add_filess" class="add shadow-lg" type="button" > Add </button> </div>
                        </form>
                       </div> <!-- row container -->
                          
                       </div>
                   </div>
            </div>
        </div>
    </div>

    
</div>
</body>
</html>



