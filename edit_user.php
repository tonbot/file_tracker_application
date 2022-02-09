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

    $user        = validate(urldecode($_GET['user']));
    $department  = validate(urldecode($_GET['department']));
    $phone       = validate(urldecode($_GET['phone']));
    $email       = validate(urldecode($_GET['email']));
   

         if ( $user == 'failed' || $department == 'failed' || $phone == 'failed' || $email == 'failed' ){
             header("location: users_management.php");
         }

       //validate function
       function validate($data){
        if(!isset($data) || $data == null || trim($data) == ""){        
            return 'failed';
        }else{
             return $data;
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EKIRS LUC</title>
    <link rel="shortcut icon" href="image/ekirs.ico">
    
    <link rel="stylesheet" href="resources/customCss/add_users.css"> <!-- edit user is making use of add_users css style -->
    <script src="resources/customJs/edit_user.js"></script>


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
                       <div class="SearchTitle"><span>Edit User</span</div>

                       <div class="frmContainer"> <!-- row container -->
                       <form  method="POST">
                       <div class="container2">
                                   <div id="add_user_message" class="text-center" >  </div>
                                   <div><label for="">Username</label></div>
                                   <div><input class="form-control" type="text" name="username" id="username" placeholder="fullname" value="<?php echo $user ?>" required></div>
                                   <div><label for="">Email</label></div>
                                   <div><input class="form-control" type="email" name="password" id="email" placeholder="email" value="<?php echo $email ?>" readonly required ></div>
                                   <div><label for="">Phone</label></div>
                                   <div><input class="form-control" type="number" name="password" id="phone" placeholder="phone" value="<?php echo $phone ?>" required ></div>
                                        <label for="">Select office</label>
                                            <select id="department" class="form-control" name="user_office" placeholder="Please select your office" >
                                                <option id="initial" value="<?php echo $department ?>"><?php echo $department ?></option>
                                                <option value="MD">MD</option>
                                                <option value="ED F'A">ED F'A</option>
                                                <option value="Budget">Budget</option>
                                                <option value="Procurement">Procurement</option>
                                                <option value="Funds">Funds</option>
                                                <option value="Other Charges">Other Charges</option>
                                                <option value="One other office">One other office</option>
                                                <option value="Audit">Audit</option>
                                                <option></option>
                                            </select>
                                    </div>   
                                </div>        
     
                           <div class="text-center pt-5 "><button id="update" class="add shadow-lg" type="button" > Update </button> </div>
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



