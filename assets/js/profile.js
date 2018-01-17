$('#password, #confirm_password').on('keyup', function () {
  if ($('#password').val() === $('#confirm_password').val()) {
    $('.sifra').addClass('has-success');
    $('.sifra').removeClass("has-error");
    $('#message').html('Podudara se').css('color', 'green');
    $('#change_profile').prop('disabled', false);
  } else {
    $('#message').html('Lozinka se nepodudara!').css('color', 'red');
    $('.sifra').addClass("has-error");
    $('.sifra').removeClass('has-success');
    $('#change_profile').prop('disabled', true);
    }
});