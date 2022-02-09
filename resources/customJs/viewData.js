
 $(document).ready(function() 
 {
    $('#btnGenerateBill').click(function()
      {
            var formData = { lga : $('#lga').val() };
            $.ajax
                ({
                    url: "post/generate_bulk_bill.php",
                    type: "POST",
                    data: formData,
                    encode:true,
                    beforeSend: function() {
                        $('#btnGenerateBill').hide();
                     },
                     complete: function(){
                        $('#btnGenerateBill').show();
                     },
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
                                        console.log(data);
                                       alert("An error occur Bill cannot be Generated");
                                    break;
                            }
                        },
                    error: function(error)
                        {
                            console.log(error);
                        }   
  
                });
   
    });
    
    //pagination dataTable call
     $('#myTable').DataTable();

});