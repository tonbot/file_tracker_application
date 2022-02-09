


    <link rel="stylesheet" href="resources/customCss/topnav.css">
    <script src="resources/topnav/topnav.js"></script>
    <script>
        $(document).ready(function(){
             $(".profiles").click(function(){
                    $(".profileContainer").toggle();
             })
             
        });
    </script>
                    <div class="topnav shadow-sm">
                        <div class="admin"> Welcome, <span id="greeting"></span> </div>
                        <ul class="adminlist ">
                            <li class="pro"><i class="fas fa-user p-2 rounded-circle bg-success text-warning profiles" id="profiles"></i> </li>   
                            <i class="fas fa-bars fa-2x"></i>                     
                        </ul>
                        <ul class="profileContainer ">
                                   <li id="profile">View Profile</a>
                                   <li id="reset"><i class="fa fa-user" aria-hidden="true"></i>Reset Password</li>
                                   <li id="logout"><i class="fas fa-sign-out-alt pr-2"  aria-hidden="true"></i>Logout</li>
                         </ul>        
                    </div>

            <!-- modal -->
           <div id="my-modal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
               <div class="modal-dialog" role="document">
                   <div class="modal-content">
                       <div class="modal-header">
                           <h5 class="modal-title" id="my-modal-title">Reset Password</h5>
                           <button class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                           <form method="POST">
                          
                           <div class="mchildren">
                                <div id="message" class="text-center py-3 mb-3"></div>
                                <div class="mb-3"><input class="form-control" type="password" name="" id="password1"  placeholder="New Password"></div>
                                <div><input class="form-control" type="password" name=""              id="password2"               placeholder="Confrim Password"></div>
                           </div>
                           </form>
                        </div>
                      
                           <div class="text-center pb-5">
                               <button class="btn btn-primary px-3" type="button" id="submitReset">Submit</button>
                               <button class=" btn btn-danger px-3" type="button" id="clearReset">Clear</button>
                          </div>
                   </div>
               </div>
           </div>
