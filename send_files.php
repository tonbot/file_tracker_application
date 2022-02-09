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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EKIRS LUC</title>
    <link rel="shortcut icon" href="image/ekirs.ico">
    
    <link rel="stylesheet" href="resources/customCss/send_files.css">
    <script src="resources/customJs/search.js"></script>
   <style>
               #displayMessage{
               width:25%;
               margin-top:20px;
               padding: 10px;
               font-size:13px;
               text-align:center;
               color:red;
        }
   </style>

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
                       <div class="searchTitle"><span>Search File To Send</span</div>
                       <div class="text-red" style="display:none; background-color:#e5e5e5" id="displayMessage"></div>
                           <form method="post" >
                                <ul>                                   
                                    <li><input class="form-control" id="inputSearch" type="text" name="file_no"  placeholder="Enter File number"></li>
                                    <li><button class="shadow" id="searchs" type="button" >Search</button></li>
                                   <!-- <li><a href="advance_search.php"><button class="shadow" id="Advance search" type="button" >Advance Search</button></a></li>-->
                                    
                                </ul>  
                            </form>
                       </div>
                   </div>

                      <div class='hasChildren2'><!-- has children 2 -->
                            <div class="searchTitle"><span>File Details</span</div>
                            <div class="text-red" style="display:none; background-color:#e5e5e5" id="displayMessage"></div>
                            <div class="row">
                                <div class="col-sm-4 titles">
                                    <label for="">File no</label>
                                    <input class="form-control" type="text" name="file_no" id="file_no" readonly>
                                </div>
                                <div class="col-sm-4 first_name">
                                    <label for="">Beneficiary</label>
                                    <input class="form-control" type="text" name="beneficiary" id="beneficiary" readonly>
                                </div>
                                <div class="col-sm-4 middle_name">
                                    <label for="">Amount</label>
                                    <input class="form-control" type="text" name="amount" id="amount" readonly>
                                </div>                            
                            </div>

                            <div class="row">
                                <div class="col-sm-4 titles">
                                    <label for="">Sending from</label>
                                    <input class="form-control" type="text" name="sending_from" id="sending_from" readonly>
                                </div>
                                <div class="col-sm-4 first_name">
                                    <label for="">Sending To</label>
                                    <select id="sending_to" class="form-control" name="sending_to"  >
                                                <option id="initial"> </option>
                                                <option id="md">MD</option>
                                                <option id="ed">ED F'A</option>
                                                <option id="budget">Budget</option>
                                                <option id="procurement">Procurement</option>
                                                <option id="funds">Funds</option>
                                                <option id="otherCharges">Other Charges</option>
                                                <option id="checking">Checking</option>
                                                <option id="audit">Audit</option>
                                            </select>
                                </div>
                                <div class="col-sm-4 middle_name">
                                    <label for="">Sending Officer</label>
                                    <input class="form-control" type="text" name="sending_officer" id="sending_officer" readonly>
                                </div>                            
                            </div>
                         
                                                                
                                    <button class="shadow" id="send" type="button" >Send</button>
                        
                      </div><!-- has children 2 ends here-->
                 
            </div>
        </div>
        <!-- footer -->
     
    </div>
</body>
</html>