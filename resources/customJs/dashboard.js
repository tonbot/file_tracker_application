$(document).ready(function()
{   
      let name2      =     sessionStorage.getItem("officer_name").trim();
      let userType2  =     sessionStorage.getItem("officer_department").trim();

      if (name2 != '' && name2 != null && userType2 != '' && userType2 != null )
        {
            switch (userType2) {
               case 'MD':
                  $('#dashboard2').show();
                  $('#add_file2').show();
                  $('#send_file2').show();
                  $('#accept_file2').hide();
                  $('#trackFile2').show();
                  $('#History2').hide();
                  $('#usersManagement2').hide();
            break;
        case "contractor":
                    $('#dashboard2').show();
                    $('#add_file2').hide();
                    $('#send_file2').hide();
                    $('#accept_file2').hide();
                    $('#trackFile2').show();
                    $('#History2').hide();
                    $('#usersManagement2').hide();
          break;
        case 'Super user':
                    $('#dashboard2').show();
                    $('#add_file2').hide();
                    $('#send_file2').hide();
                    $('#accept_file2').hide();
                    $('#trackFile2').show();
                    $('#History2').show();
                    $('#usersManagement2').show();
            break;
            case 'Super Super':
                $('#dashboard2').show();
                $('#add_file2').show();
                $('#send_file2').show();
                $('#accept_file2').show();
                $('#trackFile2').show();
                $('#History2').show();
                $('#usersManagement2').show();
        break;
        default:
                    $('#dashboard2').show();
                    $('#add_file2').show();
                    $('#send_file2').show();
                    $('#accept_file2').show();
                    $('#trackFile2').show();
                    $('#History2').hide();
                    $('#usersManagement2').hide();

              
            }
        }
           //on click of the dasboard children
          $('#dashboard2') .click(function(){
              window.location.href="dashboard.php";
          })
          $('#add_file2') .click(function(){
            window.location.href="add_files.php";
         })
         $('#send_file2') .click(function(){
            window.location.href="send_files.php";
         })
  
         $('#accept_file2') .click(function(){
            window.location.href="accept_files.php";
         })
  
         $('#trackFile2') .click(function(){
            window.location.href="track_files.php";
         })
         $('#usersManagement2') .click(function(){
            window.location.href="users_management.php";
         })

  

})