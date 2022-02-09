<?php

 class dbconnect
 {
   
   public  $pdo=null;

    function __construct() //once the class is called automatic call excute this function
    {                      //making connection to the database
        try
            {
            
                $host="localhost";
                $dbname="luc";
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
    function get_enumeration() // get enumeration by lga
        { 
            $query  = "SELECT * FROM enumeration where bill_number_status='awaiting'";
            $result = $this->pdo->query($query);  
                if ($result)
                    {                                                                       
                        $result->setFetchMode(PDO::FETCH_ASSOC);
                        $result= $result->fetchall();                     
                        return sizeof($result);
                    }                       
               else
                    {
                        return 'invalid';
                    }
                           
    
        }
 } ///end of master class
 ?>