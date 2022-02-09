
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
    include ('resources/include.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EKIRS LUC</title>
    <link rel="shortcut icon" href="image/ekirs.ico">
    
    <link rel="stylesheet" href="resources/customCss/edit_property.css"> 
    <script src="resources/customJs/advance_search.js"></script>


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
                   <div class="section2Container">
                      
                       <div class='hasChildren'>
                       <div class="SearchTitle"><span>Advance Search</span</div>

                       <div class="rowContainer"> <!-- row container -->
                       <form  method="POST">
                            <div class="row">
                                <div class="col-sm-4 titles">
                                    <label for="">Title</label>
                                    <input class="form-control" type="text" name="title" id="title" readonly>
                                </div>
                                <div class="col-sm-4 first_name">
                                    <label for="">First Name</label>
                                    <input class="form-control" type="text" name="first_name" id="first_name">
                                </div>
                                <div class="col-sm-4 middle_name">
                                    <label for="">Middle Name </label>
                                    <input class="form-control" type="text" name="middle_name" id="middle_name">
                                </div>                            
                            </div>

                            <div class="row">
                                <div class="col-sm-4 last_name">
                                    <label for="">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name">
                                </div>

                                <div class="col-sm-4 phone_number">
                                    <label for="">Phone Number</label>
                                    <input class="form-control" type="number" name="phone_number" id="phone_number">
                                </div>

                                <div class="col-sm-4 email">
                                    <label for="">Email</label>
                                    <input class="form-control" type="text" name="email" id="email">
                                </div>                     
                            </div>

                                <div class="row">
                                    
                                    <div class="col-sm-4 property_id">
                                        <label for="">Property Id</label>
                                        <input class="form-control" type="text" name="property_id" id="property_id">
                                    </div>   

                                    <div class="col-sm-4 area">
                                        <label for="">Area</label>
                                        <input class="form-control" type="text" name="area" id="area">
                                    </div> 

                                    <div class="col-sm-4 property_type">
                                        <label for="">Property type</label>
                                            <select id="property_type" class="form-control" name="property_type"  >
                                                <option id="initial"> </option>
                                                <option>Residential Building</option>
                                                <option>Hotel</option>
                                                <option>Schools</option>
                                                <option>Petrol Stations</option>
                                                <option>Telecom base stations</option>
                                                <option>Power substations</option>
                                                <option>Banks</option>
                                                <option>Microfinance banks</option>
                                                <option>Finance houses</option>
                                                <option>Insurance companies</option>
                                                <option>Industrial properties</option>
                                                <option>Hospitals</option>
                                                <option>Office Complex/Business Premises</option>
                                                <option></option>
                                            </select>
                                    </div>                            
                                </div>

                                <div class="row">

                                    <div class="col-sm-4 category">
                                        <label for="">Category</label>
                                        <select id="category" class="form-control" name="category" >
                                                <option id="initial"></option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="C">C</option>
                                                <option></option>
                                            </select>

                                    </div>
                                  
                                    <div class="col-sm-4 lga">
                                        <label for="">LGA</label>
                                        <select id="lga" class="form-control" name="lga">
                                                <option id="initial"></option>
                                                <option>Ado Ekiti</option>
                                                <option>Ikere Ekiti</option>
                                                <option>Ekiti East</option>
                                                <option>Ekiti South West</option>
                                                <option>Ekiti West</option>
                                                <option>Ido/Osi</option>
                                                <option>Irepodun/Ifelodun</option>
                                                <option>Oye</option>
                                                <option>Ikole</option>
                                                <option>Ijero</option>
                                                <option>Moba</option>
                                                <option>Ise/Orun</option>
                                                <option>Ilejemeje</option>
                                                <option>Gboyin</option>
                                                <option>Emure</option>
                                                <option>Efon</option>
                                         </select>
                                    </div>     
                             
                                    <div class="col-sm-4 zone">
                                        <label for="">Property Zone</label>
                                        <select id="zone" class="form-control" name="zone" >
                                                <option id="initial"></option>
                                                <option id="HVZ">HVZ </option>
                                                <option id="MVZ">MVZ</option>
                                                <option id="LVZ">LVZ</option>
                                                <option id="EDU">EDU</option>
                                                <option id="ENC">ENC</option>
                                                <option></option>
                                            </select>
                                    </div>
                                </div>                                      
                           

                           <div class="text-center pt-5 "><i class=" dspin fa fa-circle-notch fa-1x fa-spin pr-2"></i><button id="updateProperty" class="update shadow" type="button" >Search</button>  
                            <a href="property_search.php" ><button class="btn  ml-5 py-3 btn-primary  shadow" type="button" > Back </button></a>
                            <button class="btn  ml-5 py-3 btn-secondary  shadow clear" type="button" > Clear </button>
                        </div>
                        </form>
                           <!-- table for displaying advance search  -->
                        <div class="tableContainer">
                        <table class="table table-light table-bordered" id="myTable">
                                <thead class="thead-primary">
                                        <tr>  
                                            <th>s/n</td>  
                                            <th>First Name</th>  
                                            <th>Last Name</th>  
                                            <th>Middle Name</th>  
                                            <th>Email</th>  
                                            <th>Property Id</th> 
                                            <th>Phone Number</th> 
                                            <th>category</th> 
                                            <th>LGA</th> 
                                          </tr>  
                                </thead>
                         </table>
                        </div><!-- table for displaying advance search ends here -->
                        <div id="errorMessages" class="p-3 shadow">Please Fill Atleast A Field </div>
                       </div> <!-- row container -->
                          
                       </div>
                   </div>
            </div>
        </div>
    </div>

    
</div>
</body>
</html>



