
 $(document).ready(function() 
 {
     
    $(".hasChildren2").hide();
    //search butto focusout
    $('#searchs').focusout(function(){
        $('#displayMessage').hide();
    });
    //send button focusout
    $('#accept').focusout(function(){
        $('#displayMessage').hide();
    });

    $("#inputSearch").focus(function(){
         $(".hasChildren2").hide();
    });

   $('#searchs').click(function()
      {
            let file_no = $('#inputSearch').val().trim();
            let sending_to = sessionStorage.getItem("officer_department").trim();
            //validte input
            if(file_no==="" || file_no === null )
            {
                $('#displayMessage').show();
                $('#displayMessage').html('Field Can Not Be Empty');
            }
            else{
            var formData = { 
                file_no : file_no, 
                sending_to : sending_to,
            };
            $.ajax
                ({
                    url: "post/acceptSearch_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {     
                            console.log(data);
                            let res=JSON.parse(data);
                            if (res != "error") {
                                
                                        console.log(data);
                                      $('#file_no').val(res[0].file_no);
                                      $('#beneficiary').val(res[0].file_beneficiary);
                                      $('#amount').val(res[0].file_amount);

                                      if(sessionStorage.getItem("officer_department") == "ED F'A" ){
                                         $('#sent_by').val("MD");
                                      }else{
                                         $('#sent_by').val(res[0].sending_from);
                                      }
                                   
                                      $('#accepting_by').val(sessionStorage.getItem("officer_department"));
                                      $('#accepting_officer').val(sessionStorage.getItem("officer_name"));
                                       $(".hasChildren2").fadeIn("7000");
                                        
                                       // window.location.href="search.php?property_id="+property_id ;                                   
                                   
                            }
                             //on default then no records found
                                else{

                                      //console.log(data);
                                      $('#displayMessage').show();
                                      $('#displayMessage').html('This file has not been sent to you');
                                }
                            
                        },
                    error: function(error)
                        {
                             console.log(error); 
                        }   
  
                });
            }
   
    }); //end of on search files


    
   $('#accept').click(function()
   {
            let file_no           = $('#file_no').val().trim();
            let accepting_by      = $('#accepting_by').val().trim();
            let accepting_officer   = $('#accepting_officer').val().trim();


            //validte input
            if(accepting_by==="" || accepting_by === null )
            {
                $('#displayMessage').show();
                $('#displayMessage').html('Please select who you are sending to');
            }
            else{

            //form data to be sent
            var formData = { 
                  file_no             : file_no,
                  accepting_by        : accepting_by ,
                  accepting_officer   : accepting_officer,
            
            };
            //ajax sending form data expecting response
            $.ajax
                ({
                    url: "post/acceptFiles_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {    
                            console.log(data);
                        switch (data) {
                            case 'success' :
                                  console.log(data);
                                  $('#displayMessage').show();
                                  $('#displayMessage').html('File Successfully Accepted');
                            break;
                            case 'failed' :
                                console.log(data);
                                $('#displayMessage').show();
                                $('#displayMessage').html('File can not be accepted');
                             break;
                             case 'file already been accepted' :
                                console.log(data);
                                $('#displayMessage').show();
                                $('#displayMessage').html('File already been accepted by you');
                             break;
                      
                            }
                        },
                    error: function(error)
                        {
                            console.log(error); 
                        }   

                });
            }




   })//end of end send files
  
 

});





 
