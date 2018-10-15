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
  $('#form_careers').submit(function(e) {
    $.ajax({
      url: 'sendmail_careers.php',
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      beforeSend: function (XMLHttpRequest) {
        //
        $('.contact__form').fadeTo("slow", 0.33);
        $('#form_careers .has-error').removeClass('has-error');
        $('#form_careers .help-block').html('');
        $('#form_message').removeClass('alert-success').html('');

      },
      success: function( json, textStatus ) {
        if( json.error ) {
          // Error messages
          if( json.error.position ) {
            $('#form_careers input[name="position"]').parent().addClass('has-error');
            $('#form_careers input[name="position"]').next('.help-block').html( json.error.name );
          }
          if( json.error.salary ) {
            $('#form_careers input[name="salary"]').parent().addClass('has-error');
            $('#form_careers input[name="salary"]').next('.help-block').html( json.error.name );
          }
          if( json.error.available_date ) {
            $('#form_careers input[name="available_date"]').parent().addClass('has-error');
            $('#form_careers input[name="available_date"]').next('.help-block').html( json.error.email );
          }
          if( json.error.full_name ) {
            $('#form_careers input[name="full_name"]').parent().addClass('has-error');
            $('#form_careers input[name="full_name"]').next('.help-block').html( json.error.message );
          }
          if( json.error.birthday ) {
            $('#form_careers input[name="birthday"]').parent().addClass('has-error');
            $('#form_careers input[name="birthday"]').next('.help-block').html( json.error.message );
          }
          if( json.error.address ) {
            $('#form_careers input[name="address"]').parent().addClass('has-error');
            $('#form_careers input[name="address"]').next('.help-block').html( json.error.message );
          }
          if( json.error.province ) {
            $('#form_careers input[name="province"]').parent().addClass('has-error');
            $('#form_careers input[name="province"]').next('.help-block').html( json.error.message );
          }
          if( json.error.telephone ) {
            $('#form_careers input[name="telephone"]').parent().addClass('has-error');
            $('#form_careers input[name="telephone"]').next('.help-block').html( json.error.message );
          }
          if( json.error.email ) {
            $('#form_careers input[name="email"]').parent().addClass('has-error');
            $('#form_careers input[name="email"]').next('.help-block').html( json.error.message );
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
          $('#form_careers').fadeOut('slow');
          setTimeout(function(){
             $('#form_message').removeClass('alert-success').html('');
          },50000);
          setTimeout(function(){
             $('#contact_form').load('career-application-form.php?hotel_sec='+hotel_sec+'&language_id='+language_id);
          },50000);
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