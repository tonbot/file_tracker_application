$(document).ready(function() 
 {
        //$('#myTable2').DataTable();
     
        $('#modal-generate-new-bill').click(function()
        {
                var formData = 
                { 
                    property_id : $('#modal_property_id').val(),
                    unique_id : $('#modal_unique_id').val()       
                };
                $.ajax
                    ({
                        url: "post/generate_new_bill.php",
                        type: "POST",
                        data: formData,   //sending formdata to generate new bill .php
                        encode:true,
                        success: function(data)
                            {
                               switch (data.trim()) {
                                   case 'success':
                                           alert("New Bill Generated Successfully");
                                           window.location.reload() ; 
                                       break;
                                   case 'true':
                                           alert("Bill for this Year has already been Generated");
                                       break;
                               
                                   default:
                                       //   alert("An error occur Bill cannot be Generated");
                                       window.location.reload() ; 
                                       console.log(data);
                                       break;
                               }
                                
                            },
                        error: function(error)
                            {
                                alert("failed");  
                            }   
    
                    });
    
        });

});