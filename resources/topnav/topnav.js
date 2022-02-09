$(document).ready(function()
{   
      let officer_name         = validate(sessionStorage.getItem("officer_name"));
      let officer_department   = validate(sessionStorage.getItem("officer_department"));

      if (officer_name !='empty' && officer_department != 'empty'){
           $("#greeting").html(officer_name + " ( " + officer_department + " )");
      }else{
          window.location.href="index.php";
      }


     //logout function
    $('#logout').click(function()
        {
            sessionStorage.clear();
            window.location.href="index.php";      
        })
    //reset onclinck
    $('#reset').click(function()
        {
                $('#my-modal').modal("show");
                $(".profileContainer").toggle();
        })
    //clear modal input text
    $('#clearReset').click(function()
        {
            $('#password1').val("");
            $('#password2').val("");
        }) 
        $('.fa-bars').click(function()
        {
               
                $(".side-nav").toggle();
        })
          

    //reset password 
    $('#submitReset').click(function()
        {
                let newPassword      =validate($('#password1').val());
                let confirmPassword  =validate($('#password2').val());
                
                //checking if data is empty
                if (newPassword =='empty' || confirmPassword=='empty')
                    {
                        $('#message').html('Please fill all fields');
                        $('#message').css({'color':'RED' , 'background-color':'#e5e5e5'}); 
                        $('#message').show();
                    } 
                    else { //if  input not empty test for if  new password = confirm password
                            
                        if (newPassword != confirmPassword){
                            $('#message').html('Please ensure password is the same');
                            $('#message').css({'color':'RED' , 'background-color':'#e5e5e5'}); 
                            $('#message').show();
                        }else { //if newpassword and confirm password is the same
                                    //invoke ajax 
                                    var formData = { 
                                        newPassword :newPassword,
                                        userType:userType,
                                        uName: uName
                                 };
                                    $.ajax
                                        ({
                                            url: "post/resetPassword.php",
                                            type: "POST",
                                            data: formData, //formdata send
                                            encode:true,
                                            success: function(data)
                                                {
                                                    switch (data.trim()) {
                                                        case 'success':
                                                                $('#message').html('Password Change Successfully');
                                                                $('#message').css({'color':'green' , 'background-color':'#e5e5e5'}); 
                                                                $('#message').show();
                                                            break;
                                                        case 'update failed':
                                                                $('#message').html('Update failed');
                                                                $('#message').css({'color':'red' , 'background-color':'#e5e5e5'}); 
                                                                $('#message').show();
                                                            break;
                                                        case 'get user failed':
                                                                $('#message').html('Get user failed');
                                                                $('#message').css({'color':'red' , 'background-color':'#e5e5e5'}); 
                                                                $('#message').show();
                                                            break;
                                                        case 'failed request':
                                                                $('#message').html('Failed request');
                                                                $('#message').css({'color':'red' , 'background-color':'#e5e5e5'}); 
                                                                $('#message').show();
                                                            break;
                                                        default:
                                                            $('#message').html('Something went wrong');
                                                            $('#message').css({'color':'red' , 'background-color':'#e5e5e5'}); 
                                                            $('#message').show();
                                                        break;

                                                       
                                                    }
                                                },
                                            error: function(error)
                                                {
                                                   console.log(error); 
                                                }   
                          
                                        });
                           // console.log (newPassword,uName, userType);
                        }

                    } 
             // console.log (newPassword,confirmPassword);
           
        })
     //onfocus lost of submitReset
        $("#submitReset").focusout(function(){
            $('#message').hide();
       });











     //validate function
        function validate(data){
            if (data==null || data==""){
                return "empty"; 
            }
            else {
                let data1=data;
                    data1=data1.trim();
                    return data1;
            }
        }//end of validate


})