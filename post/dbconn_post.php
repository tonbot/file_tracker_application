<?php
 ini_set('memory_limit', '3000M');
 ini_set('max_execution_time', 0);
 class dbconn_post
 {
   
   public  $pdo=null;

    function __construct() //once the class is called automatic excute this function
    {                      //making connection to the database
        try
            {
            
                $host="localhost";
                $dbname="ferma";
                $password="";
                $user="root";
                $this->pdo=new PDO("mysql:host=$host; dbname=$dbname", $user, $password );
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
            } 
        catch(PDOException $e)
            {
                echo ($e->getMessage());
            }
    }
################################################################################################333
 //get  details of proprty search for   
 function get_details2($file_no,$sending_to)
 {    

    //only MD DEPARTMENT CAN FETCH FROM FILE TABLE DIRECTLY.
    if ($sending_to == trim("MD"))
    {
            $query      = "SELECT file_no, file_amount, file_beneficiary FROM file_table WHERE file_no = '$file_no' " ;
            $result_set = $this->pdo->query($query);
            $result_set -> setFetchMode(PDO::FETCH_ASSOC);
            $result     =  $result_set->fetchall();        
            if (sizeof($result) > 0)
            {
            return $result;
            }else{
                return('error');
            }
     }
     else
     {
        $query      = "SELECT file_table.file_no, file_amount, file_beneficiary, sending_from FROM file_send INNER JOIN file_table WHERE file_table.file_no = '$file_no' AND file_send.file_no = '$file_no' AND file_send.sending_to = :sending_to " ;
        $statement = $this->pdo->prepare($query);
        $statement->execute([ 
            ':sending_to'      => $sending_to,
        ]);
            if ( $statement -> rowCount() > 0)  
               {
                   $statement -> setFetchMode(PDO::FETCH_ASSOC);
                   $result     =  $statement->fetchall();  
                   return $result;
               }else{
                   return('error');
               }

     }
   
     
 }#################################################################################
################################################################################################333
 //get  details of proprty search for   
function get_details($file_no,$search_by)
{    
    //only MD  DEPARTMENT CAN FETCH FROM FILE TABLE DIRECTLY.
    if ($search_by == trim("MD"))
    {
            $query      = "SELECT file_no, file_amount, file_beneficiary FROM file_table WHERE file_no = '$file_no' " ;
            $result_set = $this->pdo->query($query);
            $result_set -> setFetchMode(PDO::FETCH_ASSOC);
            $result     =  $result_set->fetchall();        
            if (sizeof($result) > 0)
            {
            return $result;
            }else{
                return('error');
            }
     }    
    else{
        $query      = "SELECT file_table.file_no, file_amount, file_beneficiary, sending_from FROM file_send INNER JOIN file_table WHERE file_table.file_no = :file_no AND file_send.file_no = :file_no AND file_send.sending_to = :search_by " ;          
        $statement = $this->pdo->prepare($query);
        $statement->execute([ 
            ':search_by'      => $search_by,
            ':file_no'      => $file_no,
        ]);
            if ( $statement -> rowCount() > 0)  
               {
                   $statement -> setFetchMode(PDO::FETCH_ASSOC);
                   $result     =  $statement->fetchall();  
                   return $result;
               }else{
                   return('error');
               }
       }
    
}#################################################################################
##################################################################################
 //get  details of proprty search for   
 function get_details3($file_no)
 {    

            $query      = "SELECT file_no, file_amount, file_beneficiary, file_location, accepted_on FROM file_table WHERE file_no = :file_no" ;
            $statement = $this->pdo->prepare($query);
            $statement->execute([ 
                ':file_no'      => $file_no,
            ]);
               
            if ( $statement -> rowCount() > 0 )
                {
                    $statement -> setFetchMode(PDO::FETCH_ASSOC);
                    $result     =  $statement->fetchall();   
                    return $result;
                }
            else
                {
                    return('error');
                }
            
 }#################################################################################
function sendFiles($file_no, $sending_from, $sending_to, $sending_officer)
{   
   /** 
    *  Berfor file can be sent you have to accept the files first but
    *if the sending_from is "MD" then no need for checking if the file has been accepted.
   */
       //check if this file has already been accepted by the department it was sent to.
       if ($sending_from != "MD"){
   
       $query      = "SELECT file_accept.file_no, file_accept.accepted_by FROM file_accept WHERE file_accept.file_no = '$file_no' AND file_accept.accepted_by = :sending_from" ;
       $statement = $this->pdo->prepare($query);
       $statement->execute([ 
           ':sending_from'      => $sending_from,
       ]);
           if ( $statement -> rowCount() > 0)
       {
                            //check if file has already been sent to this department
                            $query      = "SELECT file_no FROM file_send WHERE file_no = :file_no AND sending_from = :sending_from AND sending_to = :sending_to";
                            $statement = $this->pdo->prepare($query);
                            $statement->execute([
                                ':file_no'           => $file_no,
                                ':sending_from'      => $sending_from,
                                ':sending_to'        => $sending_to
                            ]);
                                if ( $statement -> rowCount() > 0)
                                {
                                    return ('file already been sent');
                                }
                        else
                            {

                                $sending_date  = date("y/m/d");
                                $status        = "sent";
                            

                                    $query="INSERT INTO file_send (file_no, sending_to, sending_from, sending_officer, status, sending_date )
                                    VALUES  (:file_no, :sending_to, :sending_from, :sending_officer, :status, :sending_date )"; 

                                    //preparing statement for execution 
                                        $statement = $this->pdo->prepare($query);
                                        
                                    //executing query
                                        $statement->execute
                                        ([
                                            ':file_no'               => $file_no,
                                            ':sending_to'            => $sending_to,
                                            ':sending_from'          => $sending_from,
                                            ':sending_officer'       => $sending_officer,
                                            ':status'                => $status,
                                            ':sending_date'          => $sending_date,
                                        ]);
                                        
                                        //if insert is a success
                                        if ($statement){  return 'success'; }
                                                else {  return 'failed';  }
                                        
                                    
                                }// end of else
                                
                        }  //end of send filea

       else{
           return('please accept this file');
       }
    }//end of if sending from is not MD
    else{
        //if sending from is MD dont check if the file has been accepted
        $sending_date  = date("y/m/d");
        $status        = "sent";
    
            $query="INSERT INTO file_send (file_no, sending_to, sending_from, sending_officer, status, sending_date )
            VALUES  (:file_no, :sending_to, :sending_from, :sending_officer, :status, :sending_date )"; 

            //preparing statement for execution 
                $statement = $this->pdo->prepare($query);
                
            //executing query
                $statement->execute
                ([
                    ':file_no'               => $file_no,
                    ':sending_to'            => $sending_to,
                    ':sending_from'          => $sending_from,
                    ':sending_officer'       => $sending_officer,
                    ':status'                => $status,
                    ':sending_date'          => $sending_date,
                ]);
                
                //if insert is a success
                if ($statement){  return 'success'; }
                        else {  return 'failed';  }
                

    }//end of if sending from is MD


    }//END OF THE WHOLE BLOCK

################################################################################################
function acceptFiles($file_no, $accepting_by, $accepting_officer)
{   
                            //check if file has already been accepted by this department
                            $query      = "SELECT file_no FROM file_accept WHERE file_no = :file_no AND accepted_by = :accepting_by ";
                            $statement = $this->pdo->prepare($query);
                            $statement->execute([
                                ':file_no'           => $file_no,
                                ':accepting_by'      => $accepting_by,
                            ]);
                                if ( $statement -> rowCount() > 0)
                                {
                                    return ('file already been accepted');
                                }
                        else
                            {

                                $accepted_date  = date("y/m/d");
                                $status        = "sent";
                            

                                    $query="INSERT INTO file_accept (file_no, accepted_by, accepting_officer, accepted_date )
                                    VALUES  (:file_no, :accepted_by, :accepting_officer, :accepted_date )"; 

                                    //preparing statement for execution 
                                        $statement = $this->pdo->prepare($query);
                                        
                                    //executing query
                                        $statement->execute
                                        ([
                                            ':file_no'               => $file_no,
                                            ':accepted_by'           => $accepting_by,
                                            ':accepting_officer'     => $accepting_officer,
                                            ':accepted_date'         => $accepted_date,
                                        ]);
                                        
                                        //if insert is a success
                                        if ($statement){  
                                            //updating the file status in file send
                                            $query      = "UPDATE file_send SET status = 'accepted', status_date = :status_date WHERE file_no = :file_no AND sending_to = :sending_to ";
                                            $statement = $this->pdo->prepare($query);
                                            $statement->execute([
                                                ':file_no'           => $file_no,
                                                ':sending_to'        => $accepting_by,
                                                ':status_date'       => $accepted_date,
                                            ]);  
                                            //updating the file location in file table
                                            $query      = "UPDATE file_table SET file_location = :accepted_by, accepted_on = :accepted_on WHERE file_no = :file_no ";
                                            $statement = $this->pdo->prepare($query);
                                            $statement->execute([
                                                ':file_no'           => $file_no,
                                                ':accepted_by'        => $accepting_by,
                                                ':accepted_on'        => $accepted_date,
                                            ]);
                                            //return success after updating is a success
                                            return 'success';
                                         }
                                                else {  return 'failed';  }
  
                                }// end of else
 
    }

################################################################################################3
 #################################################################################
 function addFiles( $file_no,$beneficiary,$file_desc,$amount,$officer_name,$officer_department  )
 {   
  //check if phone or username already exist
  $query      = "SELECT file_no FROM file_table WHERE file_no = :file_no ";
  $statement = $this->pdo->prepare($query);
  $statement->execute([
      ':file_no'      => $file_no,
  ]);
         if ( $statement -> rowCount() > 0)
         {
             return ('true');
         }
    else
     {
             $query="INSERT INTO file_table(file_no, file_description, file_amount, file_beneficiary, file_status, officer_name,by_office)
             VALUES (:file_no, :file_description, :file_amount, :file_beneficiary, :file_status, :officer_name, :by_office)"; 

             //preparing statement for execution 
                 $statement = $this->pdo->prepare($query);
                 
                     //executing query
                 $statement->execute
                 ([
                     ':file_no'              => $file_no,
                     ':file_description'     => $file_desc,
                     ':file_amount'          => $amount,
                     ':file_beneficiary'     => $beneficiary,
                     ':file_status'          => "pending",
                     ':officer_name'         => $officer_name,
                     ':by_office'            => $officer_department,
                 ]);
                 
                 //if insert is a success
                 if ($statement){  return 'success'; }
                         else {  return 'failed';  }
                 
             
         }// end of else
         
 }  //end of add users

################################################################################################3
 #################################################################################
    function addUsers($username,$department,$email,$phone,$password)
            {   

             //check if phone or username already exist
             $query      = "SELECT email FROM user WHERE email = :email";
             $statement = $this->pdo->prepare($query);
             $statement->execute([
                 ':email'      => $email,
             ]);
                    if ( $statement -> rowCount() > 0)
                    {
                        return ('true');
                    }
               else
                {
                        $query="INSERT INTO user(user_name, password, department, phone_number, email)
                        VALUES ( :user_name, :pass, :department,  :phone,  :email)"; 

                        //preparing statement for execution 
                            $statement = $this->pdo->prepare($query);
                            
                                //executing query
                            $statement->execute
                            ([
                                ':user_name'     => $username,
                                ':pass'          => $password,
                                ':department'    => $department,
                                ':phone'         => $phone,
                                ':email'         => $email
                            ]);
                            
                            //if insert is a success
                            if ($statement){  return 'success'; }
                                    else {  return 'failed';  }
                            
                        
                    }// end of else
                    
            }  //end of add users

################################################################################################3

function get_user_post($email, $password, $department)
    {
                 //get user details
                 $query      = "SELECT user_name, department FROM user WHERE email= :email  AND password= :pass AND department = :department";
                 $statement = $this->pdo->prepare($query);
                 $password=md5($password);
                 $statement -> execute([
                    ':email'      => $email, 
                    ':pass'       => $password,
                    ':department' => $department,
                 ]);
                 if($statement->rowCount() > 0){
                     //if user details is get succesfully
                    $statement -> setFetchMode(PDO::FETCH_ASSOC);
                    $result     =  $statement->fetchall();                   
                           return ($result);      
                    }
                else { // if user details is not gotten
                        return ('false');
                    }

    }

####################################################################################################

function reset_password($uName,$userType,$newPassword)

    {
                //get user details before password is update
                 $query      = "SELECT password, user_name FROM user WHERE user_name=:uName AND userType=:userType";
                 $statement  =  $this->pdo->prepare($query);
                 $statement -> execute([
                     ':uName' => $uName,
                     ':userType' => $userType                 
                 ]); 

                 if ($statement->rowCount() > 0 )
                    { ;                           
                        //update password if  user details is found
                        $query      = "UPDATE user SET password=:newPassword WHERE user_name='$uName' AND userType='$userType'";
                        $statement  =  $this->pdo->prepare($query);
                        $statement -> execute([
                            ':newPassword' => md5($newPassword)               
                        ]);     
                          if ($statement->rowCount() > 0 ){ //update is successfull
                                 return 'success'; 
                                }
                           else {  
                                return "update failed"; 
                         }
                    }//end of update password if user details is found  

                //return failed if user details is not found
                else {  return "get user failed";  }

    }

###############################################################################################
function update_user($username,$department,$email,$phone)
            {   

             //check if email already exit 
             $query      = "SELECT * FROM user WHERE email = :email";
             $statement = $this->pdo->prepare($query);
             $statement->execute([                
                 ':email' => $email,
             ]);
                    if ( $statement -> rowCount() > 0)
                        {
                            $query="UPDATE user SET user_name = :user_name,  phone_number = :phone, department = :department WHERE email=:email";
            
                            //preparing statement for execution 
                                $statement = $this->pdo->prepare($query); 
                                    //executing query
                                $statement->execute
                                ([
                                 
                                    ':user_name'     => $username,
                                    ':phone'        => $phone,
                                    ':department'   => $department,
                                    ':email'        => $email
                                ]);
                                if ( $statement -> rowCount() > 0){
                                    return 'success';
                                }
                                
                        }
               else
                    {                   
                    return 'failed';       
                    }  

         } //end of add users

#######################################################################################
function advance_search( $first_name, $last_name, $property_type, $middle_name, $email, $phone_number, $category,  $lga, $zone, $area , $property_id )
    {
            //check if phone or username already exist
            $query      = "SELECT * FROM enumeration 
            WHERE middle_name=:middle_name 
            OR phone_number=:phone_number 
            OR first_name=:first_name 
            OR last_name=:last_name 
            OR email=:email 
            OR property_id=:property_id 
            OR zone=:zone AND lga=:lga
            OR area=:area 
            OR property_type=:property_type AND lga=:lga
            OR lga=:lga AND category=:category LIMIT 1000" ;
            $statement = $this->pdo->prepare($query);
            $statement->execute([                
                ':lga'               => $lga,
                ':middle_name'       => $middle_name,
                ':email'             => $email,
                ':phone_number'      => $phone_number,
                ':first_name'        => $first_name,
                ':last_name'         => $last_name,
                ':category'          => $category,
                ':area'              => $area,
                ':property_type'     => $property_type,
                ':zone'              => $zone,
                ':property_id'       => $property_id,
         
            ]);
                   if ( $statement -> rowCount() > 0)
                       {
                            $statement -> setFetchMode(PDO::FETCH_ASSOC);
                            $result     =  $statement->fetchAll(); 
                            return $result;   
                       }
              else
                   {                   
                       return 'zero';       
                   }  

        } //end of advance search;
        
#######################################################################################################
    
}///end of master class
 ?>