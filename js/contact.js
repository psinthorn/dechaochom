/*------------------------------------------------------------------
Project:    Mosaic
Author:     Simpleqode
URL:        http://simpleqode.com/
            https://twitter.com/YevSim
            https://www.facebook.com/simpleqode
Version:    1.3.1
Created:        20/01/2014
Last change:    06/07/2015
-------------------------------------------------------------------*/


/**
 * Contact form
 */

$(document).ready(function(e) {
  $('#form_sendemail').submit(function(e) {
    $.ajax({
      url: 'sendmail.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function (XMLHttpRequest) {
        //
        $('.contact__form').fadeTo("slow", 0.33);
        $('#form_sendemail .has-error').removeClass('has-error');
        $('#form_sendemail .help-block').html('');
        $('#form_message').removeClass('alert-success').html('');

      },
      success: function( json, textStatus ) {
        if( json.error ) {
          // Error messages
          if( json.error.name ) {
            $('#form_sendemail input[name="name"]').parent().addClass('has-error');
            $('#form_sendemail input[name="name"]').next('.help-block').html( json.error.name );
          }
          if( json.error.subject ) {
            $('#form_sendemail input[name="subject"]').parent().addClass('has-error');
            $('#form_sendemail input[name="subject"]').next('.help-block').html( json.error.name );
          }
          if( json.error.email ) {
            $('#form_sendemail input[name="email"]').parent().addClass('has-error');
            $('#form_sendemail input[name="email"]').next('.help-block').html( json.error.email );
          }
          if( json.error.message ) {
            $('#form_sendemail textarea[name="message"]').parent().addClass('has-error');
            $('#form_sendemail textarea[name="message"]').next('.help-block').html( json.error.message );
          }
          if( json.error.recaptcha ) {
            $('#form-captcha .help-block').addClass('has-error');
            $('#form-captcha .help-block').html( json.error.recaptcha );
          }
        }
        // Refresh Captcha
		grecaptcha.reset();
        //
        if( json.success ) {
          var language_id = document.getElementById("language_id").value;
          var hotel_sec = document.getElementById("hotel_sec").value;
          $('#form_message').addClass('alert-success').html( json.success );
          $('#form_sendemail').fadeOut('slow');
          setTimeout(function(){
             $('#form_message').removeClass('alert-success').html('');
          },10000);
          setTimeout(function(){
             $('#contact_form').load('contact-form.php?hotel_sec='+hotel_sec+'&language_id='+language_id);
          },3000);
        }
        
      },
      complete: function( XMLHttpRequest, textStatus ) {
        //
        $('.contact__form').fadeTo("fast", 1);
      }
    });
    
    return false;
  });
});