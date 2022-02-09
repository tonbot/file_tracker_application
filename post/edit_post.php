<?php 

        if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {   
                    
                 $title               = trim($_POST['title']);                 $first_name     = trim($_POST['first_name']);
                 $middle_name         = trim($_POST['middle_name']);           $last_name      = trim($_POST['last_name']);
                 $gender              = trim($_POST['gender']);                $email          = trim($_POST['email']);
                 $phone_number        = trim($_POST['phone_number']);          $occupation     = trim($_POST['occupation']);
                 $property_id         = trim($_POST['property_id']);           $house_number   = trim($_POST['house_number']);
                 $street              = trim($_POST['street']);                $area           = trim($_POST['area']);
                 $landmark            = trim($_POST['landmark']);              $property_name  = trim($_POST['property_name']);
                 $property_type       = trim($_POST['property_type']);         $area_size      = trim($_POST['area_size']);
                 $building_type       = trim($_POST['building_type']);         $building_purpose = trim($_POST['building_purpose']);
                 $category            = trim($_POST['category']);              $area_class     =   trim($_POST['area_class']);
                 $lga                 = trim($_POST['lga']);                 
                 $zone                = trim($_POST['zone']);
      
                                #including dbconnection
                                include_once "dbconn_post.php"; //this 
                                #making a connection object
                                $connect = new dbconn_post;
                                #if connection not null
                                if ($connect != null)
                                                  
                                        {
                                            #get lga code in lga_codes table;
                                            $lga_code = $connect->get_lga_code($lga);   
                                            #get propery type codes in property type codes table;  
                                            //check if property type is Residential building. if yes fetch from building type
                                            if ($property_type =='Residential Building') 
                                                {
                                                   #determine property type code
                                                    $prop_type = $building_type;
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                   #####################################################################################3333 
                                                     #determine the chargeable rate for Residential using formula 
                                                     $build_purpose = $building_purpose;
                                                    // echo $lga, $zone, $prop_type, $build_purpose;
                                                     $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);


                                                }   
                                            else
                                                {    

                                                    $prop_type= $property_type; 
                                                    $property_type_code = $connect ->get_property_code($lga,$zone,$prop_type);
                                                    #########################################################################
                                                         //prop_type can be any value execept Residential Building
                                                         //if prop_type is equall to school then building purpose will be equal to school_category value.
                                                            switch ($prop_type) 
                                                            {
                                                                case 'Schools':
                                                                    $build_purpose = $building_purpose;
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                                //if prop_type is not equal to school and not equal to Residential Building 
                                                                //then buill purpose will be equal to Business    
                                                                default:
                                                                    $build_purpose='Business';
                                                                    $rate = $connect->get_rate($lga,$zone,$prop_type,$build_purpose);
                                                                    break;
                                                            }
                                                }  
                                            ###############                       
                                            #initialisng bill number staus
                                           //$bill_number_status="awaiting";                                        
                                             $response = $connect->update_property_info ( $title,            $first_name,     $middle_name,
                                            $last_name,         $gender,          $email,
                                            $phone_number,       $occupation,      $property_id,
                                            $house_number,       $street,          $area,         $landmark, 
                                            $property_name,      $property_type,   $area_size,  
                                            $building_type,      $build_purpose,   $category, 
                                            $area_class,         $lga,             $lga_code,  
                                            $property_type_code, $zone,            $rate 

                                         ); //register ends here

                                            echo ($response);
                                                
                                              
                                                
                                        } 
      
            }
 
?>