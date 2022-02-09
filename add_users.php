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
    <script src="resources/customJs/add_users.js"></script>


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
                       <div class="SearchTitle"><span>Add Users</span</div>

                       <div class="frmContainer"> <!-- row container -->
                       <form  method="POST">
                                <div class="container2">
                                   <div id="add_user_message" class="text-center" >  </div>
                                   <div><label for="">Username</label></div>
                                   <div><input class="form-control" type="text" name="username" id="username" placeholder="fullname" required></div>
                                   <div><label for="">Email</label></div>
                                   <div><input class="form-control" type="email" name="password" id="email" placeholder="email" required ></div>
                                   <div><label for="">Phone</label></div>
                                   <div><input class="form-control" type="text" name="password" id="phone" placeholder="phone" required ></div>
                                   
                                        <label for="">Select office</label>
                                            <select id="department" class="form-control" name="user_office"  >
                                                <option id="initial"> </option>
                                                <option>MD</option>
                                                <option>ED F'A</option>
                                                <option>Budget</option>
                                                <option>Procurement</option>
                                                <option>Funds</option>
                                                <option>Other Charges</option>
                                                <option>Checking</option>
                                                <option>Audit</option>
                                                <option>contractor</option>
                                                <option>Super user</option>
                                                <option>Super Super</option>
                                                <option></option>
                                            </select>
                                    </div>   
                                </div>              
                           <div class="text-center pt-5 "><button id="addUser" class="add shadow-lg" type="button" > Add </button> </div>
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



