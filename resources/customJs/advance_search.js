$(document).ready(function(){
    
    $(".dspin").hide();

  //hide error messages on focus out of the click of search button;
  $('#updateProperty').focusout(function(){
      $('#errorMessages').hide();
  });

  $('#message').hide();
  // THIS AUTOMATICALLY EXECUTE WHEN PAGE LOADS


      $('#myTable').DataTable();
      $('.tableContainer').show();
                        
   //form sumbit ajax
  $('#updateProperty').click(function()
      {
           //checking the caption of the button when clicked before it perform any function        
        
              let last_name          = $('#last_name').val().trim();
              let first_name         = $('#first_name').val().trim();             
              let middle_name        = $('#middle_name').val().trim();          
              let email              = $('#email').val().trim();
              let phone_number       = $('#phone_number').val().trim();        
              let property_id        = $('#property_id').val().trim();         
              let area               = $('#area').val().trim();
              let property_type      = $('#property_type').val().trim();          
              let category           = $('#category').val().trim();             
              let lga                = $('#lga').val().trim();                 
              let zone               = $('#zone').val().trim();
             
       
                         //validate search request
                          if ( zone==='' && email==='' && middle_name==='' && first_name==='' && last_name==='' && phone_number==='' &&
                               property_id==='' && area==='' && property_type==='' && category==='' && lga===''  ){
                      
                                
                              $('#errorMessages').text("Please Fill Atleast A field");
                              $('#errorMessages').show();

                          }
                          else 
                          {
                                  
                            var formData = 
                            {
                                first_name          : $('#first_name').val(),
                                last_name           : $('#last_name').val(),           
                                middle_name         : $('#middle_name').val(),          
                                email               : $('#email').val(),
                                phone_number        : $('#phone_number').val(),         
                                property_id         : $('#property_id').val(),                     
                                property_type       : $('#property_type').val(),            
                                category            : $('#category').val(),            
                                lga                 : $('#lga').val(),                 
                                zone                : $('#zone').val(),
                                area                : $('#area').val(),
                            };
              
                              $.ajax
                                  ({
                                      url: "post/advance_search_post.php",
                                      type: "POST",
                                      data: formData,
                                      cache:false,
                                      beforeSend:function(){
                                          $(".dspin").show();
                                      },
                                      complete:function(){
                                          $(".dspin").hide();
                                      },
                                      encode:true,
                                      success: function(data)
                                          {           
                                                  // console.log(data);
                                                    let response=JSON.parse(data);
                                                    
                                                 if (response !='zero' )
                                                    {
                                                              $('#myTable').DataTable().clear();
                                                             
                                                               count=1;
                                                              for(let i=0; i < response.length; i++){
                                                                  $('#myTable').dataTable().fnAddData([
                                                                       count++,
                                                                     response[i].first_name,
                                                                     response[i].last_name,
                                                                     response[i].middle_name,
                                                                     response[i].email,
                                                                     response[i].property_id,
                                                                     response[i].phone_number,
                                                                     response[i].category,
                                                                     response[i].lga,

                                                                  ]);
                                                              }
                                                      } 

                                                      if (response === 'zero'){
                                                                                              
                                                              $('#errorMessages').text("No records found");
                                                              $('#errorMessages').show();
                                                       
                                                      }
                                            // console.log((JSON.parse(data)));
                                          },
                                      error: function(error)
                                          {
                                              console.log(error);
                                          }   
                                  });
                                  
                    }
         
}); //end of click search button

    $('.clear').click(function(){
        $('#last_name').val('');
        $('#first_name').val('');             
        $('#middle_name').val('');          
        $('#email').val('');
        $('#phone_number').val('');        
        $('#property_id').val('');         
        $('#area').val('');
        $('#property_type').val('');          
        $('#category').val('');             
        $('#lga').val('');                 
        $('#zone').val('');
    }); //end of clear button



})