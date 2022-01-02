$('input[name=address_zipcode]').on('blur', function () {

  var cep = $(this).val();

  $.ajax({
      url: 'https://viacep.com.br/ws/'+cep+'/json/',
      type: 'GET',
      dataType: 'json',
      success: function (result) {
          // Se existir irei pegar as informações contidas no CEP
          if (typeof result.logradouro != 'undefined') {
              $('input[name=address]').val(result.logradouro);
              $('input[name=address_neighb]').val(result.bairro);
              $('input[name=address_city]').val(result.localidade);
              $('input[name=address_state]').val(result.uf);
              $('input[name=address_country]').val("Brasil");
              $('input[name=address_number]').focus();
          } else {
              alert("CEP não encontrado, por favor preencha um CEP válido.");
          }
      }
  });
});

$('textarea#internal_obs').tinymce({
    
});

