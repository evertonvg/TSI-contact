var verificar; 
$(document).ready(function(){
    
    $("a[rel=modal]").click( function(ev){    //clique para todo menu que tiver rel=modal
        ev.preventDefault();                  //cancela o evento padrão do link
 
        var id = $(this).attr("data-janela");        //captura o valor de data-janela...no caso o id do modal
 
        // var alturaTela = $(document).height();//pega a altura do navegador
        // var larguraTela = $(document).width();  //pega a largura do navegador
     
        // //colocando o fundo preto
        // $('#mascara').css({'width':larguraTela,'height':alturaTela}); //coloca as dimensoes do navegador na tela de fundo
        $('#mascara').fadeIn(1000);           //efeito de aparição de elemento hide com 1000ms
        $('#mascara').fadeTo("slow",0.8);     //efeito de opacidade com o tempo
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 ); //calcula a posicao da largura do modal(largura da tela/2 -2 largura do modal/2)
        var top = ($(window).height() / 2) - ( $(id).height() / 2 ); //calcula a posicao da altura do modal(altura da tela/2 -2 altura do modal/2)

        $('html,body').css({"overflow":"hidden"}); //impede de dar scroll na tela
        $(id).css({'top':top,'left':left});   //coloca no css o valor da posicao
        $(id).show();                         //mostra o modal

        var carrega_url = this.id;
        carrega_url = carrega_url + ".php";  
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                    $('.window').focus();
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                    $('.window').focus();
                }
            }) 
    });
    
 
    $('#mascara').click( function(){
        $('.carrega').css({display:"block"});
        $(this).hide();                //esconde a mascara
        $(".window").hide();           //esconde a janela modal
        $('html,body').css({"overflow":"auto"});
    });
 
    $('.window').on('click','#fechar,#nao2',function(ev){
        ev.preventDefault();            //evita o efeito normal do link
        $('.carrega').css({display:"block"});
        $("#mascara").hide();           //esconde a mascara
        $(".window").hide();           //esconde a janela modal
        $('html,body').css({"overflow":"auto"});
        
    });

    $('.window').on('click', '.categoria1', function(ev){
        ev.preventDefault();
        var carrega_url = "registrar.php";
        var cat = $('.categoria1').val();
        $('#tituloShow').html('<h3>Digite seu nº de Siape:</h3>');
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                    $('#tituloShow').html('<h3>Digite seu nº de siape:</h3>');
                    $('#categoria').val(cat);
                    $('#registro2').attr("placeholder","Siape - 9 digitos");
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                    $('.window').focus();
                }
            }) 
    });

    $('.window').on('click', '.categoria2', function(ev){
        ev.preventDefault();
        var carrega_url = "registrar.php";
        var cat = $('.categoria2').val();
        
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                    $('#tituloShow').html('<h3>Digite seu nº de matricula:</h3>');
                    $('#categoria').val(cat);
                    $('#registro2').attr("placeholder","nº de matricula - 12 digitos");
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                    $('.window').focus();
                }
            }) 
    });

    $('.window').on('click', '.categoria3', function(ev){
        ev.preventDefault();
        var carrega_url = "registrar.php";
        var cat = $('.categoria3').val();
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                    $('#tituloShow').html('<h3>Digite seu nº de matricula:</h3>');
                    $('#categoria').val(cat);
                    $('#registro2').attr("placeholder","nº de matricula - 12 digitos");
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                    $('.window').focus();
                }
            })  
    });



    $('.window').on('click', '.verificar ', function(ev){
        ev.preventDefault();
        $('.oi').show();
        $('#verificar').hide();
        $('#registro2').attr('readonly', true);
        var registro = $('#registro2').val();
        var categoria = $('#categoria').val();
        $.ajax({
            url: 'solicitacao_registro.php',
            type:"POST",
            data:{registro:registro,categoria:categoria},
            dataType:"json",
            success: function(dados){
                
                if(dados==null){
                    $('#registro2').val('');
                    $('.oi').hide();
                    $("#campohidden").show();
                    $('#campohidden').html('<h4 style="text-align:center;">Não foram encontrados resultados!</h4>');
                    $('#registro2').attr('readonly', false);
                    verificar='1';
                    } 
                else{
                    $('#nomePessoa').val(dados.nome); 
                    verificar='0';
                    }                 
                },
            beforeSend: function(){
                    $('.window').css({display:"block"});
                },
            complete: function(){
                    $('.carrega').css({display:"none"});
                    $('.window').focus();
                },
            error: function() {
                    $("#campohidden").html("<h4>O servidor não conseguiu processar o pedido</h4>");
                    $("#campohidden").show();

                }
        });
    });

    $('.window').on('click','.nao', function(ev){
        ev.preventDefault(); 
        $('.oi').hide();
        $('#registro2').val('');
        $('#verificar').show();
        $("#campohidden").hide();
        $('#registro2').attr('readonly', false);
    });    

    $('.window').on('click','#registro2', function(){
        if(verificar=='1'){
            $("#campohidden").hide();
            $("#verificar").show();
        }
    });
    $("fechar2").click( function(ev){
        ev.preventDefault(); 
        $(".mensagem_php").hide();
    });

        

    $('.window').on('click','.voltar', function(ev){
        var carrega_url = this.id;
        carrega_url = carrega_url + ".php";
        $('#forme').fadeIn(1000);  
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                }
            }) 
    });

    
    $("a[rel=modal2]").click( function(ev){    //clique para todo menu que tiver rel=modal
        ev.preventDefault();                  //cancela o evento padrão do link
 
        var id = $(this).attr("data-janela");        //captura o valor de data-janela...no caso o id do modal
        
        // var alturaTela = $(document).height();//pega a altura do navegador
        // var larguraTela = $(window).width();  //pega a largura do navegador
     
        // //colocando o fundo preto
        // $('#mascara').css({'width':larguraTela,'height':alturaTela}); //coloca as dimensoes do navegador na tela de fundo
        $('#mascara').fadeIn(1000);           //efeito de aparição de elemento hide com 1000ms
        $('#mascara').fadeTo("slow",0.8);     //efeito de opacidade com o tempo
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 ); //calcula a posicao da largura do modal(largura da tela/2 -2 largura do modal/2)
        var top = ($(window).height() / 2) - ( $(id).height() / 2 ); //calcula a posicao da altura do modal(altura da tela/2 -2 altura do modal/2)

     
        $(id).css({'top':top,'left':left});   //coloca no css o valor da posicao
        $(id).show();                         //mostra o modal
        $('html,body').css({"overflow":"hidden"});
        var id2 = $(this).attr("href");
        var carrega_url = id2; 
       
       
        $.ajax({
                url: carrega_url,
                success: function(data){
                    $('.window').html(data);
                },
                beforeSend: function(){
                    $('.window').css({display:"block"});
                },
                complete: function(){
                    $('.carrega').css({display:"none"});
                    
                }
            }) 
    });

    var apelido = $("#apelido").attr("value"),
        email = $("#email").attr("value"),
        wpp = $("#wpp").attr("value"),
        foto_velha = $('#src_perfil').attr("src");

        

    $("#editar").click( function(ev){
        ev.preventDefault(); 
        $('#editar,#modificar').hide();
        $('#salvar,#cancelar,#apelido,#paragrafoapelido').removeClass("hidden");
        $('#salvar,#cancelar,#paragrafoapelido,#apelido').show();    
        $('#email,#wpp').removeAttr("readonly");
        $('.fundopreto').show();
        $('.upload_div').show();
    });

    $("#cancelar").click( function(ev){
        ev.preventDefault(); 
        $('#editar,#modificar').show();
        $('#salvar,#cancelar,#apelido,#paragrafoapelido').hide(); 
        $('#email,#wpp').attr('readonly',true);   
        $('#email').val(email);
        $('#wpp').val(wpp);
        $('#apelido').val(apelido);
        $('.fundopreto').hide();
        $('.upload_div').hide();
        $('#src_perfil').attr("src",foto_velha);
    });

     $("#upload_link").click(function(e){
        e.preventDefault();
        $("#upload_file:hidden").trigger('click');
    });

   
     $("#bt_menuu").click(function(){
        var naveg = $(".naveg");
        if(naveg.hasClass('open')){
            naveg.css("margin-top","-100%");
            naveg.removeClass('open');
            
        }
        else {
            naveg.css("margin-top","75px");
            naveg.addClass('open');
        } 
        $(window).resize(function(){
            var larguraTela = $("body").width();
            if (larguraTela>1050){
                $(".naveg").css("margin-top","0px");
            }
        });
        $(window).resize(function(){
            var larguraTela = $("body").width();
            if (larguraTela<=1050){
                $(".naveg").css("margin-top","-500px");
            }
         });
     });

     $(window).resize(function(){
        var larguraTela = $("body").width();
        if (larguraTela>1050){
            $(".naveg").css("margin-top","0px");
        }
     });

     $(window).resize(function(){
        var larguraTela = $("body").width();
        if (larguraTela<=1050){
            $(".naveg").css("margin-top","-500px");
        }
        // $('body').click(function (event) {
        //     if((event.target.class!='.naveg')||(event.target.id!='bt_menuu')){
        //       $(".naveg").css("margin-top","-500px");
        //     }
        // });
     });

     $("#busca").focus(function(){
        var larguraTela = $("body").width();
        if (larguraTela<=1050){
            $("#bt_menuu").hide();
            $(".naveg").css("margin-top","-500px");
        }
     });

     $("#busca").blur(function(){
        var larguraTela = $("body").width();
        if (larguraTela<=1050){
            $("#bt_menuu").show();
        }
     });
     


     $(".seguranca1").click(function(){
        // var larguraTela = $("body").width();
        // if (larguraTela<=1050){
            if($(".seguranca1").hasClass("deactive")){
                $(".naveg li ul").css("display","block");
                $(".seguranca1").removeClass("deactive");
            }
            else{
                $(".naveg li ul").css("display","none");
                $(".seguranca1").addClass("deactive");
            }
        // }
        
     });

       $(".seguranca1").hover(function(ev){
            ev.preventDefault();
        });



       $("form").submit(function(e){
            if($("#ambiente").val()!=''){
                $("#ambiente").css("border","none");
            }

            if($("#turno").val()!=''){
                $("#turno").css("border","none");
            }

            if($("#ambiente").val()==''){
                $("#ambiente").css("border","3px solid red");
                $("#ambiente").focus();
                return false;
            }
            if($("#turno").val()==''){
                $("#turno").css("border","3px solid red");
                $("#turno").focus();
                return false; 
            }
            e.preventDefault();
            var ambiente = $('#ambiente').val();
            var turno = $('#turno').val();
            var carrega_url = 'aulaHorarios.php?ambiente='+ambiente+'&turno='+turno;
            console.log(carrega_url);
            $.ajax({
                url: carrega_url,
                type:"GET",
                // data:{ambiente:ambiente,turno:turno},
                // dataType:"json",
                success: function(data){
                    $('.tabelahorarios p').hide();
                    $('.tabelahorarios').html(data);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                  }
                
            })
            
       });
});

