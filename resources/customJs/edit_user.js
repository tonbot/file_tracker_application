
 $(document).ready(function() 
 {
    $('#add_user_message').hide();
    $('#update').click(function()
          
      {
              
                let user_name  = $('#username').val();
                let department = $('#department').val();
                let email      = $('#email').val();
                let phone      = $('#phone').val();
             

                if ( user_name==="" || user_name === null || department==="" || department === null ||
                      email==="" || email === null || phone==="" || phone === null
                   )
                    {     
                        $('#add_user_message').text("Please fill all field");
                        $('#add_user_message').css({"color": "red", "background-color": "#e5e5e5", });
                        $('#add_user_message').show();
                         
                    }
             else{
                        // console.log(fullname,username,email,phone,userType);
           var formData = {

                 username    :  user_name,
                 department  :  department,
                 email       :  email,
                 phone       :  phone,
                 
                 };

            $.ajax //ajax call
                ({
                    url: "post/edit_user.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {
                            switch (data.trim()) {
                                case 'success':

                                    $('#add_user_message').text("Update Successfull");
                                    $('#add_user_message').css({"color": "white", "background-color": "green", });
                                    $('#add_user_message').show();
                                     
                                    break;
                                case 'failed':
                                    $('#add_user_message').text("Update Can Not Be Made");
                                    $('#add_user_message').css({"color": "red", "background-color": "#e5e5e5", });
                                    $('#add_user_message').show();
                                    break;
                                default:
                                       console.log(data);
                                    break;
                            }
                        },
                    error: function(error)
                        { alert("failed"); }   
                }); //end of ajax */
             }//end of else
    }); //end of adduser click ebent
    
    //
    $("#update").focusout(function(){
           $('#add_user_message').hide();
      });
   

});