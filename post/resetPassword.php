  <?php 
  //IF REQUEST METHOD IS EQUAL TO POST
     if($_SERVER['REQUEST_METHOD']=='POST'){
            $newPassword  =  validate($_POST['newPassword']);
            $uName        =  validate($_POST['uName']);
            $userType     =  validate($_POST['userType']);
                
            //text the value of form data if equal to failed
               if( $newPassword=='failed' ||  $uName=='failed' ||  $userType=='failed'){
                   return 'invalid user data';
               }else{ //if not equal to failed
                          //including database file with connection
                          include_once 'dbconn_post.php';

                          //making an object of class dbconn  
                          $connect=new dbconn_post;

                          // passing three parameters to reset users password in dbconn_post
                          $response=$connect->reset_password($uName,$userType,$newPassword);
                          switch ($response) {
                              case 'success':
                                    echo 'success';
                                  break;
                              
                              case 'update failed':
                                    echo 'update failed';
                                  break;
                              case 'get user failed':
                                    echo 'get user failed';
                                   break;
                             
                          }

               }


     }else { // IF REQUETST METHOD IS NOT EQUAL TO POST
         echo "failed request";
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