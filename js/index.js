$(document).ready(function(){
    
        $('#formaRegistracija').keypress(function(){
            $('.log-status').removeClass('wrong-entry');
            $('.log-status-user').removeClass('wrong-entry');
            $('.log-status-email').removeClass('wrong-entry');
            $('.log-status-pass').removeClass('wrong-entry');
        });

    });
    function provera()
    {
            var username=$('#tbUsername').val();
            var password=$('#tbPassword').val();
            if(username==="" || username.length<5)
            {
                event.preventDefault();
                 $('.log-status-user').addClass('wrong-entry');
                 $('.alert').fadeIn(500);
                 setTimeout( "$('.alert').fadeOut(1500);",3000 );  
            }
            
            if(password==="")
            {
                event.preventDefault();
                $('.log-status-pass').addClass('wrong-entry');
                $('.alert').fadeIn(500);
                setTimeout( "$('.alert').fadeOut(1500);",3000 );
            } 
    }
    function registracijaProvera()
    {
            var username=$('#tbUsername').val();
            var password=$('#tbPassword').val();
            var confirm=$('#tbConfirmPassword').val();
            var email=$('#tbEmail').val();
            
            if(username==="" || username.length<5)
            {
                event.preventDefault();
                 $('.log-status-user').addClass('wrong-entry');
                 $('.alert').fadeIn(500);
                 setTimeout( "$('.alert').fadeOut(1500);",3000 );  
            }
            
            if(password==="")
            {
                event.preventDefault();
                $('.log-status-pass').addClass('wrong-entry');
                $('.alert').fadeIn(500);
                setTimeout( "$('.alert').fadeOut(1500);",3000 );
            }
            if(email==="")
            {
                event.preventDefault();
                $('.log-status-email').addClass('wrong-entry');
                $('.alert').fadeIn(500);
                setTimeout( "$('.alert').fadeOut(1500);",3000 );
            }
            if(confirm==="")
            {
                event.preventDefault();
                $('.log-status').addClass('wrong-entry');
                $('.alert').fadeIn(500);
                setTimeout( "$('.alert').fadeOut(1500);",3000 );
            }
            if(password!=="" && password.length>5 && username!=="" && username.length>5 && confirm!=="" && email!=="")
            {
                return true;
            }
    }