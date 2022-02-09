
 $(document).ready(function() 
 {
    $('#add_user_message').hide();
    $('#add_filess').click(function()
          
      {
              
        let file_no             = $('#file_no').val();
        let beneficiary         = $('#beneficiary').val();
        let file_desc           = $('#file_desc').val();
        let amount              = $('#amount').val();
        let officer_name        = sessionStorage.getItem('officer_name');
        let officer_department  = sessionStorage.getItem('officer_department');

     
        if ( file_no==="" || file_no === null || beneficiary==="" || beneficiary === null ||
             file_desc==="" || file_desc === null || amount==="" || amount === null ||
             officer_department==="" || officer_department === null || officer_name==="" || officer_name === null
           )
                    {     
                        $('#add_user_message').text("Please fill all fields");
                        $('#add_user_message').css({"color": "red", "background-color": "#e5e5e5", "font-size":"13px"   });
                        $('#add_user_message').show();
                         
                    }
             else{

            var formData = {
                
                file_no             :   file_no ,
                beneficiary         :   beneficiary,
                file_desc           :   file_desc,
                amount              :   amount,
                officer_name        :   officer_name,
                officer_department  :   officer_department
                 
                 };

            $.ajax //ajax call
                ({
                    url: "post/addFiles_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {
                            switch (data.trim()) {
                                case 'success':

                                    $('#add_user_message').text("New file Added ");
                                    $('#add_user_message').css({"color": "white", "background-color": "green", "font-size":"13px" });
                                    $('#add_user_message').show();
                                     
                                    break;
                                case 'true':
                                    $('#add_user_message').text("File already exist");
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