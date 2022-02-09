
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

<?php
     include 'dbconn.php';  
     $connect=new dbconn;
     $response=$connect->get_users();
     $number = sizeof($response); 
         $i=0;     
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EKIRS LUC</title>
    <link rel="shortcut icon" href="image/ekirs.ico">
    
    <link rel="stylesheet" href="resources/customCss/users_management.css">
    <script src="resources/customJs/users_management.js"></script>
  <script>
      
 </script>

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
                 <div id="hisChildren" style="padding-left:30px; padding-right:30px;padding-top:30px;padding-bottom:30px;background-color: #c5c5c5; height:100vh;" >
                   <div class="btnContainer">
              
                       <ul>
                           <li><a href="add_users.php"><button class="btnGenerateBill shadow-lg" >Add User</button></a></li>
                       </ul>
                   </div>
                  <div class="tableContainer"><!--section container start here -->   
                    <table class="table table-light table-bordered" id="myTable">
                        <thead class="thead-white">
                                <tr>  
                                   
                                    <th>s/n</td>  
                                    <th>Username</th>  
                                    <th>Email</th> 
                                    <th>Phone</th> 
                                    <th>Department</th> 
                                    <th>Action</th> 
                               
                                </tr>  
                        </thead>
                        <tbody>
                            <?php   foreach($response as $data) { 
                                          
                                           
                                ?>
                                <tr>
                                    
                                    <td><?php echo $i+1 ?></td>
                                    <td><?php echo $data['user_name']?></td>
                                    <td><?php echo $data['email']?></td>
                                    <td><?php echo $data['phone_number']?></td>
                                    <td><?php echo $data['department']?></td>
                                    <td class="text-center"><a href='edit_user.php?user=<?php echo urlencode($data['user_name'])?>&department=<?php echo urlencode($data['department'])?>&phone=<?php echo urlencode($data['phone_number'])?>&email=<?php echo urlencode($data['email'])?> '>
                                    <i class="fas fa-edit"></i></a></td>
                                                                     
                                </tr>
                                <?php   $i++; } ?>                           
                        </tbody>
                       
                    </table>                    
                  </div><!--section container ends  here -->
                  </div>
            </div>
        </div>
          <!-- footer -->
          
    </div>
</body>
</html>