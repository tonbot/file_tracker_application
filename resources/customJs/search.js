
 $(document).ready(function() 
 {
     //logic for sending to
     let sending_from = sessionStorage.getItem("officer_department").trim();
     switch (sending_from) {
         case "MD":      
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').show();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
         case "ED F'A": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').show();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
         case "Budget": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="procurement"]').show();
            $('#sending_to').children('option[id="funds"]').show();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
         case "Procurement": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').show();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
        case "Funds": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').show();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
      case "Other Charges": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').show();
            $('#sending_to').children('option[id="audit"]').hide();
            break;
     case "One other office": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="procurement"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').show();
            break;
     case "Audit": 
            $('#sending_to').children('option[id="md"]').hide();
            $('#sending_to').children('option[id="ed"]').hide();
            $('#sending_to').children('option[id="budget"]').hide();
            $('#sending_to').children('option[id="funds"]').hide();
            $('#sending_to').children('option[id="procurement"]').show();
            $('#sending_to').children('option[id="otherCharges"]').hide();
            $('#sending_to').children('option[id="checking"]').hide();
            $('#sending_to').children('option[id="audit"]').hide();
     }



    $(".hasChildren2").hide();
    //search butto focusout
    $('#searchs').focusout(function(){
        $('#displayMessage').hide();
    });
    //send button focusout
    $('#send').focusout(function(){
        $('#displayMessage').hide();
    });

    $("#inputSearch").focus(function(){
         $(".hasChildren2").hide();
    });

   $('#searchs').click(function()
      {
            let file_no = $('#inputSearch').val().trim();
         
            //validte input
            if(file_no==="" || file_no === null )
            {
                $('#displayMessage').show();
                $('#displayMessage').html('Field Can Not Be Empty');
            }
            else{

            var formData = { 
                file_no      : file_no,
                search_by : sending_from
            };

            $.ajax
                ({
                    url: "post/search_post.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    success: function(data)
                        {    
                            console.log(data)
                            let res=JSON.parse(data);
                            if (res != "error") {
                                
                                        console.log(data);
                                      $('#file_no').val(res[0].file_no);
                                      $('#beneficiary').val(res[0].file_beneficiary);
                                      $('#amount').val(res[0].file_amount);
                                      $('#sending_from').val(sessionStorage.getItem("officer_department"));
                                      $('#sending_officer').val(sessionStorage.getItem("officer_name"));
                                      $(".hasChildren2").fadeIn("7000");
                                        
                                       // window.location.href="search.php?property_id="+property_id ;                                   
                                   
                            }
                             //on default then no records found
                                else{

                                      //console.log(data);
                                      $('#displayMessage').show();
                                      $('#displayMessage').html('File not found');
                                }
                            
                        },
                    error: function(error)
                        {
                             console.log(error); 
                        }   
  
                });
            }
   
    }); //end of on search files


    
   $('#send').click(function()
   {
            let file_no           = $('#file_no').val().trim();
            let sending_from      = $('#sending_from').val().trim();
            let sending_to        = $('#sending_to').val().trim();
            let sending_officer   = $('#sending_officer').val().trim();


            //validte input
            if(sending_to==="" || sending_to === null )
            {
                $('#displayMessage').show();
                $('#displayMessage').html('Please select who you are sending to');
            }
            else{

            //form data to be sent
            var formData = { 
                  file_no         : file_no,
                  sending_from    : sending_from ,
                  sending_to      : sending_to,
                  sending_officer : sending_officer,
            };
            //ajax sending form data expecting response
            $.ajax
                ({
                    url: "post/sendFiles_post.php",
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
                                  $('#displayMessage').html('File Sent Successfully');
                            break;
                            case 'failed' :
                                console.log(data);
                                $('#displayMessage').show();
                                $('#displayMessage').html('File failed to send');
                             break;
                             case 'file already been sent' :
                                console.log(data);
                                $('#displayMessage').show();
                                $('#displayMessage').html('File already sent by you');
                             break;
                             case 'please accept this file' :
                                console.log(data);
                                $('#displayMessage').show();
                                $('#displayMessage').html('Please accept this file before you send');
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





 
