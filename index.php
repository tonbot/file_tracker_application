
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
    <link rel="stylesheet" href="resources/customCss/index.css">
    <script src="resources/customJs/index.js"></script>
</head>
<body>
    <div class="motherContainer">
     
        <div class="text-center imgClass" ><img  src="image/ferma_logo.png" width="300px" height="auto" alt=""> </div>
              

        <div class="hasChildren">
                 <div class="frmContainer">
                    <form method="post">
                    <i class="far fa-user fa-2x "></i>
                    <i class="fas fa-lock fa-2x"></i>
                        <div id="message"></div>
    
                        <div><input class="form-control" type="text" name="" id="email"  placeholder="email"></div>
                        
                        <div><input class="form-control" type="password" name="password" id="password"  placeholder="Password "></div>
                        
                        <div class="property_type">
                                        <label for="">Select office</label>
                                            <select id="department" class="form-control" name="department"  >
                                                <option id="initial"> </option>
                                                <option>MD</option>
                                                <option>ED F'A</option>
                                                <option>Budget</option>
                                                <option>Procurement</option>
                                                <option>Funds</option>
                                                <option>Other Charges</option>
                                                <option>Checking</option>
                                                <option>Audit</option>
                                                <option>contractor</option>
                                                <option>Super user</option>
                                                <option>Super Super</option>
                                                <option></option>
                                            </select>
                                    </div>            
                       
                        <div class="text-center"><button type="button" id="login" >Login</button></div>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>