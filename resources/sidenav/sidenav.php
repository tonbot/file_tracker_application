
<?php 
       #include database connnection
       include_once 'resources/sidenav/dbconnect.php';
      #initiallise database connection
      $connect=new dbconnect;
      $response_get=$connect->get_enumeration();

?>


                
              <!DOCTYPE html>
              <html lang="en">
              <head>
                  <meta charset="UTF-8">
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Document</title>
                  <link rel="stylesheet" href="resources/customCss/sidenav.css">   
                  <script src="resources/sidenav/sidenav.js"></script>
              </head>
              <body>
              <div class="col-lg-2 side-nav">
                    <div class="title">FERMA e-Portal</div>
                    
                    <ul>
                        <div id="titleMain">menu</div>
                     <a id="dashboard"  href="dashboard.php"><li><i class="fas fa-tachometer-alt mr-3 ml-3  text-warning"></i>Dashboard</li></a> 
                     <a id="add_file" href="add_files.php"><li><i class="fa  fa-chart-line text-warning mr-3 ml-3" aria-hidden="true"></i>Add Files</span></li></a> 
                     <a id="send_file" href="send_files.php"><li><i class="fa fa-print text-warning mr-3 ml-3" aria-hidden="true"></i>Send Files</li></a> 
                     <a id="accept_file" href="accept_files.php"><li><i class="fa fa-file text-warning mr-3 ml-3" aria-hidden="true"></i>Accept File</li></a> 
                     <a id="trackFile" href="track_files.php"><li><i class="fa fa-search text-warning mr-3 ml-3" aria-hidden="true"></i>Track File</li></a> 
                     <a id="History" href="#"><li><i class="fa fa-print text-warning mr-3 ml-3" aria-hidden="true"></i>History</li></a> 
                     <a id="usersManagement" href="users_management.php"><li>Users Management</li></a>   
                    </ul>
               <!--     <div class="text-center"><button class="btn btn-success" id="side-logout">Logout</button></div> -->
                   

                </div>
              </body>
              </html>     
               