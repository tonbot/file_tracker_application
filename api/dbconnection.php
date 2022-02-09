<?php

 class dbconnection 
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
  //House enumeration starts here
function register(

    $title,               $first_name,        $middle_name,
    $last_name,           $gender,            $email,
    $phone_number,        $occupation,        $property_id,
    $house_number,        $street,            $area,        $landmark, 
    $property_name,       $property_type,     $area_size,  
    $building_type,       $building_purpose,  $category, 
    $area_class,          $lga,               $lga_code,  
    $property_type_code,  $zone,              $rate,  
    $agent_id,            $mac_address,       $longitude, 
    $latitude,            $bill_number_status

) 
 {                #checking if enumeration exist to avoid duplicate
                   $query="SELECT property_id FROM enumeration WHERE property_id = :property_id";
                   $check = $this->pdo->prepare($query);
                   $check->execute([
                       ':property_id' => $property_id
                   ]);
                       if($check->rowCount() > 0){
                           #data existed
                           return "existed";
                       } 
                       else{ #save to the database

                                #generating unigue number for each enumeration
                                $unique_id = str_pad('22', 6, mt_rand(0,9). mt_rand(0,9). mt_rand(0,9));
                                $unique_id = $unique_id.date('ms');
                                #setting enumerating year
                                $year=date('Y');
                                #if house enumeration does not exist, then create one.
                                $query     ="INSERT INTO enumeration(  
                                    unique_id,
                                    title,                first_name,         middle_name,
                                    last_name,            gender,             email,
                                    phone_number,         occupation,         property_id,
                                    house_number,         street,             area,        landmark, 
                                    property_name,        property_type,      area_size,  
                                    building_type,        building_purpose,   category, 
                                    area_class,           lga,                lga_code,  
                                    property_type_code,   zone,               rate,  
                                    agent_id,             mac_address,        longitude, 
                                    latitude,             bill_number_status, date_created
                            
                                )

                                VALUES (
                                                    :unique_id,
                                                    :title,                :first_name,         :middle_name,
                                                    :last_name,            :gender,             :email,
                                                    :phone_number,         :occupation,         :property_id,
                                                    :house_number,         :street,             :area,         :landmark, 
                                                    :property_name,        :property_type,      :area_size,  
                                                    :building_type,        :building_purpose,   :category, 
                                                    :area_class,           :lga,                :lga_code,  
                                                    :property_type_code,   :zone,               :rate,  
                                                    :agent_id,             :mac_address,        :longitude, 
                                                    :latitude,             :bill_number_status, :date_created

                                        )";


                                $statement = $this->pdo->prepare($query);
                                $statement->execute

                                    ([  
                                        ':unique_id'         => $unique_id,  
                                        ':title'             => $title,                   ':first_name'         => $first_name,           ':middle_name'    => $middle_name,
                                        ':last_name'         => $last_name,               ':gender'             => $gender,               ':email'          => $email,
                                        ':phone_number'      => $phone_number,            ':occupation'         => $occupation,           ':property_id'    => $property_id, 
                                        ':house_number'      => $house_number,            ':street'             => $street,               ':area'           => $area,           ':landmark' => $landmark, 
                                        ':property_name'     => $property_name,           ':property_type'      => $property_type,        ':area_size'      => $area_size,   
                                        ':building_type'     => $building_type,           ':building_purpose'   => $building_purpose,     ':category'       => $category,  
                                        ':area_class'        => $area_class,              ':lga'                => $lga,                  ':lga_code'       => $lga_code,  
                                        ':property_type_code'=> $property_type_code,      ':zone'               => $zone,                 ':rate'           => $rate,  
                                        ':agent_id'          => $agent_id,                ':mac_address'        => $mac_address,          ':longitude'      =>  $longitude,
                                        ':latitude'          => $latitude,                ':bill_number_status' => $bill_number_status,   ':date_created'   => $year
                                    ]);

                                        if ($statement->rowCount() > 0)
                                            {
                                                return "success";
                                            }
                                        else
                                            {
                                                return "failed";
                                            }
                        }#end of data does not exist

 }   #end of register method

############################################################################################
      function login($email, $password) // login user;
        { 
            $query  = "SELECT * FROM user WHERE email=:email AND password =:pass";
            $password=md5($password);
            $result = $this->pdo->prepare($query);   
            $result->execute
                ([
                    ':email'    => $email,
                    ':pass' => $password
                ]);
                     if($result->rowCount() > 0){
                        return 'success';
                     }
                     else
                     {
                         return 'failed';
                     }             
    
        } //end of login method
##################################################################################
   //get lga codes start here
   function get_lga_code($lga)
        {
            $query      = "SELECT lga_code FROM lga_codes WHERE lga='$lga'";
            $result_set = $this->pdo->query($query);
            $result_set ->setFetchMode(PDO::FETCH_ASSOC);
            $result     = $result_set->fetchall();        
             foreach( $result as $rows )
                {
                    $response = $rows['lga_code'];   
                          
                }
                return $response;
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

//enumertion log
function logg(
                $title,               
                $first_name,      
                $middle_name,
                $last_name,           
                $gender,          
                $email,
                $phone_number,        
                $occupation,     
                $property_id,
                $house_number,        
                $street,          
                $area,         
                $landmark, 
                $property_name,       
                $property_type,  
                $area_size,  
                $building_type,       
                $building_purpose,  
                $category, 
                $area_class,          
                $lga,            
                $lga_code,  
                $property_type_code,  
                $zone,           
                $rate,  
                $agent_id,           
                $mac_address,     
                $longitude, 
                $latitude,            
                $path 

)
{
    $filename=fopen( $path."//paymentlog//".$first_name.".txt", "w");
    $write=fwrite( $filename,   "title =". $title . ' ' . PHP_EOL     . ' ' .                     "first_name=".$first_name . ' ' .  PHP_EOL     . ' ' .        "middle_name=". $middle_name . ' ' .PHP_EOL     . ' ' .  
                                "last_name =". $last_name . ' ' .    PHP_EOL     . ' ' .                 "gender=".$gender . ' ' .     PHP_EOL     . ' ' .             "email=". $email . ' ' . PHP_EOL     . ' ' .  
                                "phone_number =". $phone_number . ' ' .   PHP_EOL     . ' ' .            "occupation=".$occupation . ' ' .   PHP_EOL     . ' ' .       "property_id=". $property_id . ' ' . PHP_EOL     . ' ' .  
                                "house_number =". $house_number . ' ' .     PHP_EOL     . ' ' .          "street=".$street . ' ' .        PHP_EOL     . ' ' .          "area=". $area . ' ' .PHP_EOL     . ' ' .  
                                "property_name =". $property_name . ' ' .   PHP_EOL     . ' ' .          "property_type=".$property_type . ' ' . PHP_EOL     . ' ' .   "area_size=". $area_size . ' ' .PHP_EOL     . ' ' .  
                                "building_type =". $building_type . ' ' .    PHP_EOL     . ' ' .         "building_purpose=".$building_purpose . ' ' . PHP_EOL     . ' ' .   "category=". $category . ' ' .PHP_EOL     . ' ' .  
                                "area_class =". $area_class . ' ' .  PHP_EOL     . ' ' .                 "lga=".$lga . ' ' .    PHP_EOL     . ' ' .                    "lga_code=". $lga_code . ' ' .PHP_EOL     . ' ' .  
                               "property_type_code =". $property_type_code . ' ' .PHP_EOL     . ' ' .   "zone=".$zone . ' ' .  PHP_EOL     . ' ' .                    "rate=". $rate . ' ' .PHP_EOL     . ' ' .  
                                "agent_id =". $agent_id . ' ' .   PHP_EOL     . ' ' .                    "mac_address=".$mac_address . ' ' .  PHP_EOL     . ' ' .      "longitude=". $longitude . ' ' .PHP_EOL     . ' ' .  
                                "latitude =". $latitude . ' ' .       PHP_EOL     . ' ' .                "landmark=".$landmark . ' ' .    PHP_EOL     . ' ' .          "longitude=". $longitude  
        
                             );   
    fclose($filename);
    return ("success");
}
################################################################################################################################
function demand_notice($property_id, $extension){

    #check if property id exist in the images table
    $query= "SELECT property_id FROM images WHERE property_id = :property_id";
    $response = $this->pdo->prepare($query);
    $response->execute([
        ':property_id' => $property_id,
    ]);
    
     #if property id exist then insert the demand_image 
    if ($response -> rowCount() > 0){
        $query= "UPDATE images SET demand_image = :demand_image WHERE property_id = :property_id ";
        $response = $this->pdo->prepare($query);
            $response->execute([
                ':property_id'    => $property_id,
                ':demand_image'   => $property_id.".".$extension
            ]);
                if ($response -> rowCount() > 0){
                    return ("success");
                }
                else{
                    return ("failed");
                }

    } #end of if property id exist
    else{
        return ("failed");
    }
    
   
}// end of demand_notice
##############################################################################################################################################
function save_enumeration_image($property_id, $extension){
    #check if property id exist in the images table
   $query= "SELECT property_id FROM images WHERE property_id = :property_id";
   $response = $this->pdo->prepare($query);
   $response->execute([
       ':property_id' => $property_id,
   ]);
    #if property id exist then do nothing 
   if ($response -> rowCount() > 0){
         return "exist";
   } #end of if property id exist
   else{
    $query= "INSERT INTO images (property_id, enumeration_image1) VALUES ( :property_id, :enumeration_image1)";
    $response = $this->pdo->prepare($query);
        $response->execute([
            ':property_id'          =>   $property_id,
            ':enumeration_image1'   =>  "e_".$property_id.".".$extension,
        ]);
            if ($response -> rowCount() > 0){
                return ("success");
            }
            else{
                return ("failed");
            }

   }
   

} #end of save enumeration image
 } ///end of master class
 ?>