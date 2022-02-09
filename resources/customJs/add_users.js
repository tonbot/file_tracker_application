
 $(document).ready(function() 
 {
    $('#add_user_message').hide();
    $('#addUser').click(function()
          
      {
              
        let user_name  = $('#username').val();
        let department = $('#department').val();
        let email      = $('#email').val();
        let phone      = $('#phone').val();
     
        if ( user_name==="" || user_name === null || department==="" || department === null ||
              email==="" || email === null || phone==="" || phone === null
           )
                    {     
                        $('#add_user_message').text("Please fill all fields");
                        $('#add_user_message').css({"color": "red", "background-color": "#e5e5e5", "font-size":"13px"   });
                        $('#add_user_message').show();
                         
                    }
             else{

            var formData = {
                
                 username    :  user_name,
                 department  :  department,
                 email       :  email,
                 phone       :  phone,
                 
                 };

            $.ajax //ajax call
                ({
                    url: "post/addUsers_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {
                            switch (data.trim()) {
                                case 'success':

                                    $('#add_user_message').text("New user Added ");
                                    $('#add_user_message').css({"color": "white", "background-color": "green", "font-size":"13px" });
                                    $('#add_user_message').show();
                                     
                                    break;
                                case 'true':
                                    $('#add_user_message').text("Username taken! Choose another name");
                                    $('#add_user_message').css({"color": "red", "background-color": "#e5e5e5", "font-size": "11px" });
                                    $('#add_user_message').show();
                                    break;
                                default:
                                       alert(data);
                                    break;
                            }
                        },
                    error: function(error)
                        { alert("failed"); }   
                }); //end of ajax
             }//end of else
    }); //end of adduser click ebent
    
    //
    $("#addUser").focusout(function(){
           $('#add_user_message').hide();
      });
   

});