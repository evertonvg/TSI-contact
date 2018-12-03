$(function($){
  var Main = {
    init : function(){
      Main.bind.mask.call();
      Main.bind.valida.call();
    },
    bind : {
      mask: function(){
        $('.date').mask('00/00/0000');
        $('.time').mask('00:00:00');
        $('.date_time').mask('00/00/0000 00:00:00');
        $('.cep').mask('00000-000');
        // $('.phone_ddd').mask('(00) 0000-0000');
        // $('.placa').mask('AAA 0000');
        $('.cpf').mask('000.000.000-00');
        $('.dinheiro').mask('000.000.000.000.000,00', {reverse: true});
        $('.dinheiro2').mask("#.##0,00", {reverse: true});
//

        var telefone = function (val) {
          return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        Options = { 
          onKeyPress: function(val, e, field, options) {
              field.mask(telefone.apply({}, arguments), options);
            }
        };

        $('.phone_ddd').mask(telefone, Options);


        $('.placa').mask('AAA 0000', {translation: {'A': {pattern: /[a-zA-Z]/}}});
      },
      valida: function(){
        function validaForm(){
          var valido = true;

          $('input').each(function(key, value){
            if($(this).val() == ""){
              valida = false;
              $(this).parent().addClass('erro');
            } else {
              $(this).parent().removeClass('erro');
            }
          });

          if ($('.login5').val().length < 10){
            $('.login5').parent().addClass('erro');
            valida = false;
          } else {
            $('.login5').parent().removeClass('erro');
          }

          if ($('.senha5').val().length < 10){
            $('.senha5').parent().addClass('erro');
            valida = false;
          } else {
            $('.senha5').parent().removeClass('erro');
          }
          
          if ($('.date').val().length < 10){
            $('.date').parent().addClass('erro');
            valida = false;
          } else {
            $('.date').parent().removeClass('erro');
          }

          if ($('.date').val().length < 10){
            $('.date').parent().addClass('erro');
            valida = false;
          } else {
            $('.date').parent().removeClass('erro');
          }

          if ($('.time').val().length < 8){
            $('.time').parent().addClass('erro');
            valida = false;
          } else {
            $('.time').parent().removeClass('erro');
          }

          function validaEmail(){
            var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (!re.test($('.email').val().toLowerCase())) {
              $('.email').parent().addClass('erro');
              return false;
            } else {
              $('.email').parent().removeClass('erro');
            }
          }

          valida = validaEmail();

          function validaCPF(strCPF){
            var Soma;
            var Resto;
            Soma = 0;
            strCPF = strCPF.replace(/\D/g, '');
            if (strCPF == "00000000000") return false;

            if (strCPF == "11111111111") return false;

            if (strCPF == "22222222222") return false;

            if (strCPF == "33333333333") return false;

            if (strCPF == "44444444444") return false;

            if (strCPF == "55555555555") return false;

            if (strCPF == "66666666666") return false;

            if (strCPF == "77777777777") return false;

            if (strCPF == "88888888888") return false;

            if (strCPF == "99999999999") return false;

          	for (i=1; i<=9; i++)
              Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
          	  Resto = (Soma * 10) % 11;

              if ((Resto == 10) || (Resto == 11))
                Resto = 0;
              if (Resto != parseInt(strCPF.substring(9, 10)) )
                return false;

          	  Soma = 0;
              for (i = 1; i <= 10; i++)
                Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
              Resto = (Soma * 10) % 11;

              if ((Resto == 10) || (Resto == 11))
                Resto = 0;
              if (Resto != parseInt(strCPF.substring(10, 11) ) )
                return false;
              return true;
          }

          if($(".cpf").val().length < 14 || !validaCPF($(".cpf").val()) ){
            $('.cpf').parent().addClass('erro');
            valida = false;
          } else {
            $('.cpf').parent().removeClass('erro');
          }

          var validaData = function(str) {
              var partes = /^(\d{2})[-\/](\d{2})[-\/](\d{4})$/.exec(str),
                  date = partes[2] + '/' + partes[1] + '/' + partes[3];

              return !!new Date(date).getTime();
          }

          if(!validaData($(".date").val()) ){
            $('.date').parent().addClass('erro');
            valida = false;
          } else {
            $('.date').parent().removeClass('erro');
          }

          return valida;
        }

        $('.name').keyup(function () {
          this.value = this.value.replace(/[^a-zA-ZÀ-ú ]/g,'');
        });
        $('.name').blur(function () {
          this.value = this.value.replace(/[^a-zA-ZÀ-ú ]/g,'');
        });

        $('form .js-enviar').click(function(e) {
          e.preventDefault();

          var valida = validaForm();

          if(valida){
            $('form').submit();
          }
        });
      }
    }
  };

  Main.init.call();
});
