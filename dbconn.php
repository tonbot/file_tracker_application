<?php

 class dbconn
 {
   
   public  $pdo=null;

    function __construct() //once the class is called automatic call excute this function
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
  //House enumeration starts her

############################################################################################
    function get_enumeration($lga) // get enumeration by lga
        { 
            $query  = "SELECT * FROM enumeration where bill_number_status='awaiting' AND lga='$lga'";
            $result = $this->pdo->query($query);  
                if ($result)
                    {                                                                       
                        $result->setFetchMode(PDO::FETCH_ASSOC);
                        $result= $result->fetchall();                     
                        return $result;
                    }                       
               else
                    {
                        return 0;
                    }
                           
    
        } //end of get enumertion by lga
##################################################################################
   //get lga start here
   function get_lga()
        {
            $query      = "SELECT lga FROM lga_codes";
            $result_set = $this->pdo->query($query);
            $result_set ->setFetchMode(PDO::FETCH_ASSOC);
            $result     = $result_set->fetchall();              
            return $result;
        }        
   //get lga codes ends here
###################################################################################3 
   // get property code starts here
   function get_property_code($lga,$zone,$prop_type)
        {
            $query      = "SELECT property_type_code FROM property_type_codes WHERE lga='$lga' AND zone='$zone' AND property_type='$prop_type'";
            $result_set = $this->pdo->query($query);
            $result_set -> setFetchMode(PDO::FETCH_ASSOC);
            $result     =  $result_set->fetchall();        
             foreach( $result as $rows )
                {
                    $response = $rows['property_type_code'];   
                           
                }
                    return $response; 
        }
    // get property codes ends here
##############################################################################################
        function get_rate($lga,$zone,$prop_type,$build_purpose)
            {
                $query      = "SELECT rate FROM rate_table WHERE lga='$lga' AND zone='$zone' AND property_type='$prop_type' AND building_purpose='$build_purpose'";
                $result_set = $this->pdo->query($query);
                $result_set -> setFetchMode(PDO::FETCH_ASSOC);
                $result     =  $result_set->fetchall();        
                 foreach( $result as $rows )
                    {
                        $response = $rows['rate'];   
                               
                    }
                        return $response; 
            }  //get rate charges ends here
###############################################################################################

        function get_details($property_id, $query)
        {
            $statement = $this->pdo->prepare($query);
            $statement -> execute([
                ':property_id' => $property_id
            ]);
            if ($statement -> rowCount() > 0)
            {
                $statement -> setFetchMode(PDO::FETCH_ASSOC);
                $result     =  $statement->fetchall();  
                return  $result;
            }
            else
            {
               return  'no result found';
            }
           
           
        }
###########################################################################################
            function get_enumeration_by_propertyId($property_id)
            {    
                $query      = "SELECT * FROM enumeration WHERE property_id =:property_id" ;
                $statement = $this->pdo->prepare($query);
                $statement -> execute([
                    ':property_id' => $property_id
                ]);
                if ($statement -> rowCount() > 0)
                        {
                            $statement -> setFetchMode(PDO::FETCH_ASSOC);
                            $result     =  $statement->fetchall();  
                            return  $result;
                        }
                 else
                      {
                          return  'no result found';
                      }
                
            }
     
###########################################################################################
    function get_bill_pdf_details($bill_number, $bill_year, $property_id){

                $query      = "SELECT * FROM enumeration INNER JOIN bill_table ON 
                              enumeration.property_id='$property_id' AND bill_table.property_id='$property_id'
                              WHERE bill_table.bill_number='$bill_number' AND bill_year='$bill_year'" ;
                             $result_set = $this->pdo->query($query);
                             $result_set -> setFetchMode(PDO::FETCH_ASSOC);
                             $result     =  $result_set->fetchall();  

                               if ( sizeof($result ) > 0)
                               {
                                 
                                         
                                    return  $result;
                               }
                               else{
                                    return  'no result found';
                               }
            
            }

##########################################################################################
function get_users()
        {
            $query      = "SELECT * FROM user" ;
            $result_set = $this->pdo->query($query);
            $result_set -> setFetchMode(PDO::FETCH_ASSOC);
            $result     =  $result_set->fetchall();        
            if (sizeof($result) > 0)
            {
                return  $result;
            }
            
        }
##########################################################################################
//get payment status using bill number in payment table
function get_payment_details($billnumber, $query){
         
    $statement=$this->pdo->prepare($query);
    $statement->execute([
        ':billnumber' => $billnumber
    ]);
        if ($statement->rowcount() > 0){
            return 'paid';
        }
        else{
            return 'not paid';
        }
}
##########################################################################################
//get payment history
function get_payment_history($billnumber){
    if (is_numeric($billnumber)){
    $query="SELECT * FROM payment_table WHERE bill_number=:billnumber ";
    $statement=$this->pdo->prepare($query);
    $statement->execute([
        ':billnumber' => $billnumber
    ]);
        if ($statement->rowcount() > 0){
            $statement -> setFetchMode(PDO::FETCH_ASSOC);
            $statement     =  $statement->fetchall();  
            return   $statement;
        }
        else{
            return 'history not found';
        }
    }   
}
############################################################################################
function get_receipt_details($receipt_number, $printed_by, $printed_date)
    {
        //check if receipt number can be found
        $query="SELECT * FROM payment_table WHERE receipt_number=:receipt_number";
        $statement=$this->pdo->prepare($query);
        $statement->execute([
            ':receipt_number' => $receipt_number
        ]);
            if ($statement->rowCount() > 0){
                //if receipt number is valid 
                $query="UPDATE payment_table SET printed_by =:printed_by, printed_date =:printed_date, print_status=:print_status WHERE receipt_number=:receipt_number";
                //PREPARE QUERY
                      $statement2=$this->pdo->prepare($query);
                      //EXECUTE QUERY
                      $statement2->execute([
                          ':printed_by'     => $printed_by,
                          ':printed_date'   => $printed_date,
                          ':print_status'   => "printed",
                          ':receipt_number'   => $receipt_number,
                      
                      ]);
                         //IF UPDATE IS SUCCESSFULL
                        if($statement2->rowCount() > 0){
                            $statement -> setFetchMode(PDO::FETCH_ASSOC);
                            $statement     =  $statement->fetchAll();  
                            return   $statement;
                        }else{ 
                            //if update is not successsful
                            return "something went wrong";
                        }
            }else{
                    //if receipt number is not valid
                    return 'Invalid Receipt Number';
            }

    }






 } ///end of master class
 ?>