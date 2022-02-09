
 $(document).ready(function() 
 {
    $('#message').hide();
    $('#login').click(function()
          
      {
              
            
                let email = $('#email').val();
                let password = $('#password').val();
                let department = $('#department').val();
               

                if (  email==="" || email === null || password==="" || password === null || department==="" || department === null )
 
                    {     
                        $('#message').text("Please fill all fields");
                        $('#message').css({"color": "red", "background-color": "#e5e5e5", });
                        $('#message').show();
                         
                    }
             else{

            var formData = {
     
                 email    : email,
                 password    :  password,
                 department    :  department,
               
                 };

            $.ajax //ajax call
                ({
                    url: "post/index_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {
                            console.log(data);
                            if (data != 'user not exist') {
                                       let res=JSON.parse(data);
                                      // console.log ((res));
                                    sessionStorage.setItem("officer_department", res[0].department);
                                    sessionStorage.setItem("officer_name",        res[0].user_name);
                                      
                                      // let userType = 
                                      window.location.href="dashboard.php";
                              }
                                else{
                                    $('#message').text("Email or Password not correct ");
                                    $('#message').css({"color": "red", "background-color": "#e5e5e5", });
                                    $('#message').show();
                                   // console.log ((data));
                                  
                                
                                    }
                        },
                    error: function(error)
                        { console.log(error); }   
                }); //end of ajax
             }//end of else
    }); //end of adduser click ebent
    
    $("#login").focusout(function(){
        $('#message').hide();
   });
        
  
});