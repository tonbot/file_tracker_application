$(document).ready(function()
{   
      let name=sessionStorage.getItem("officer_name");
      let userType=sessionStorage.getItem("officer_department");
      if (name != '' && name != null && userType != '' && userType != null )
        {
            switch (userType) {
                case 'MD':
                          $('#dashboard').show();
                          $('#add_file').show();
                          $('#send_file').show();
                          $('#accept_file').hide();
                          $('#trackFile').show();
                          $('#History').hide();
                          $('#usersManagement').hide();
                    break;
                case "contractor":
                            $('#dashboard').show();
                            $('#add_file').hide();
                            $('#send_file').hide();
                            $('#accept_file').hide();
                            $('#trackFile').show();
                            $('#History').hide();
                            $('#usersManagement').hide();
                  break;
                case 'Super user':
                            $('#dashboard').show();
                            $('#add_file').hide();
                            $('#send_file').hide();
                            $('#accept_file').hide();
                            $('#trackFile').show();
                            $('#History').show();
                            $('#usersManagement').show();
                    break;
                    case 'Super Super':
                        $('#dashboard').show();
                        $('#add_file').show();
                        $('#send_file').show();
                        $('#accept_file').show();
                        $('#trackFile').show();
                        $('#History').show();
                        $('#usersManagement').show();
                break;
                default:
                            $('#dashboard').show();
                            $('#add_file').show();
                            $('#send_file').show();
                            $('#accept_file').show();
                            $('#trackFile').show();
                            $('#History').hide();
                            $('#usersManagement').hide();

              
            }
        }
    
            //window.location.href="index";      
            $('#side-logout').click(function(){
                sessionStorage.clear();
                location.href="index.php";
            });
  

})