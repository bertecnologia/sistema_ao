var timerID;
var segundos;

$(document).ready(function() {
	
	window.moveTo(0,0);
	window.resizeTo(screen.width,screen.height);
	$('#footer').css({'bottom':0});

	$('.fancybox').click(function() {
		var href = $(this).attr('href');
		$.fancybox({
			href: href
			,type: 'iframe'
			,width:860
			,height:550
		});
		return false;
	});
	
	$('#curso_avancar,#curso_voltar').live('click', function() {
		$('#curso_avancar,#curso_voltar').hide();
		
		if ($(this).attr('id') == 'curso_avancar') {
			var direcao = 'right';
		} else {
			var direcao = 'left';
		}
		navega($(this).attr('href'), direcao);
		
		return false;
	});

	voce_sabia(1);
		
	$('#testefinal').submit(function(){
		if(!$(this).find('input:checked')[0] && $('#segundos').val() == 2400){
			alert('Responda no mínimo uma pergunta.');
			return false;
		}
	});
	
	if ($('#segundos')[0]) {
		segundos = $('#segundos').val();
		timerID = window.setInterval("contar()",1000);
	}

	$('.resposta').live('click', function() {
		var _pergunta = $(this).data('pergunta');
		$('.resposta-' + _pergunta).removeClass('active');
		$(this).addClass('active');
		$(this).find('input').attr('checked', true);
	});

	$('.resposta-remove').live('click', function() {
		if ($('#pontos')[0] && parseInt($('#pontos').text()) >= 10) {
			var _button = $(this);
			var _curso = $(this).data('curso');
			var _pergunta = $(this).data('pergunta');
			var _conteudo = $(this).data('conteudo');

			_button.attr('disabled', true);

			$.ajax({
				url:'/orc/_ajax/curso-remove-alternativa.php'
				,data:{
					curso:_curso
					,pergunta:_pergunta
					,conteudo:_conteudo
				}
				,type:'POST'
				,dataType:'json'
				,success:function(data) {
					if (data.ok) {
						var _resposta = $('#resposta-' + _pergunta + '-' + data.remove);

						_resposta.addClass('inactive');

						for(i=0;i<2;i++) {
							_resposta.fadeTo('fast', 0.5).fadeTo('fast', 1.0);
						}

						_resposta.slideUp(function() {
							$(this).remove();
						});

						_button.remove();
						showStar('-' + data.pontos);
						$('#pontos').text( (parseInt($('#pontos').text()) - data.pontos) );
						$('#resposta-mostra-' + _pergunta).data('alternativas', 4);
					} else {
						alert('Você só pode Remover uma alternativa 3 vezes em cada curso.');
						_button.attr('disabled', false);
					}
				}
			})
		} else {
			alert('Você não possui saldo de pontos suficiente para remover esta alternativa.\n\nVocê precisa de pelo menos 10 pontos.');
		}
		return false;
	});

	$('.resposta-mostra').live('click', function() {
		if ($('#pontos')[0] && parseInt($('#pontos').text()) >= 20) {
			var _button = $(this);
			var _curso = $(this).data('curso');
			var _pergunta = $(this).data('pergunta');
			var _conteudo = $(this).data('conteudo');
			var _alternativas = $(this).data('alternativas');

			_button.attr('disabled', true);

			$.ajax({
				url:'/orc/_ajax/curso-mostra-alternativa.php'
				,data:{
					curso:_curso
					,pergunta:_pergunta
					,conteudo:_conteudo
					,alternativas:_alternativas
				}
				,type:'POST'
				,dataType:'json'
				,success:function(data) {
					if (data.ok) {
						$('.resposta-' + _pergunta + ':eq(' + data.mostra + ')').click();
						for(i=0;i<3;i++) {
							$('.resposta-' + _pergunta + ':eq(' + data.mostra + ')').fadeTo('fast', 0.5).fadeTo('fast', 1.0);
						}
						_button.remove();
						showStar('-' + data.pontos);
						$('#pontos').text( (parseInt($('#pontos').text()) - data.pontos) );
					} else {
						alert('Só é possível Perguntar aos colegas de curso 3 vezes por curso.');
						_button.attr('disabled', false);
					}
				}
			})
		} else {
			alert('Você não possui saldo de pontos suficiente para perguntar aos colegas.\n\nVocê precisa de pelo menos 20 pontos.');
		}
		return false;
	});

	$('.resposta-responde').live('click', function() {
		if ($('#pontos')[0] && parseInt($('#pontos').text()) >= 15) {
			var _button = $(this);
			var _curso = $(this).data('curso');
			var _pergunta = $(this).data('pergunta');
			var _pergunta_i = $(this).data('pergunta_i');
			var _conteudo = $(this).data('conteudo');
			var _cadastro = $(this).data('cadastro');

			_button.attr('disabled', true);

			$.ajax({
				url:'/orc/_ajax/curso-responde-alternativa.php'
				,data:{
					curso:_curso
					,pergunta:_pergunta
					,pergunta_i:_pergunta_i
					,conteudo:_conteudo
					,cadastro:_cadastro
				}
				,type:'POST'
				,dataType:'json'
				,success:function(data) {
					if (data.ok) {
						if ($('.resposta-' + _pergunta + ':eq(' + data.mostra + ')')[0]) {
							$('.resposta-' + _pergunta + ':eq(' + data.mostra + ')').click();
							for(i=0;i<3;i++) {
								$('.resposta-' + _pergunta + ':eq(' + data.mostra + ')').fadeTo('fast', 0.5).fadeTo('fast', 1.0);
							}
						}
	
						_button.remove();
						showStar('-' + data.pontos);
						$('#pontos').text( (parseInt($('#pontos').text()) - data.pontos) );
					} else {
						alert('Responder igual a um colega só é permitido 3 vezes em cada curso.');
						_button.attr('disabled', false);
					}
				}
			})
		} else {
			alert('Você não possui saldo de pontos suficiente para consultar à resposta do colega.\n\nVocê precisa de pelo menos 15 pontos.');
		}
		return false;
	});

});

function navega(url, direcao) {
	$('#curso').animate({opacity: 0.4, marginLeft : 0}, 100, function() {

		$('html, body').animate({scrollTop: '0px'}, 200);
		
		$('.loading').css('top', $('#curso').height()/2);
		$('.loading').fadeIn();
		
		if (direcao == 'right') {
			var margem = '-100%';
		} else {
			var margem = '100%';
		}
		
		$.ajax({
			type: 'POST'
			,url: url+'&json=1'
			,dataType: 'json'
			,success: function(data) {
				if (data) {

					if (data.botao_anterior) {
						$('#curso_voltar').attr('href', data.link_botao_anterior).show();
					} else {
						$('#curso_voltar').hide();
					}
					
					if (data.botao_proximo) {
						$('#curso_avancar').attr('href', data.link_botao_proximo).show();
					} else {
						$('#curso_avancar').hide();
					}

					if (data.reflexao) {
						$('#curso_help').show();
					} else {
						$('#curso_help').hide();
					}
					
					$('#porcentagem').text(data.porcentagem + '%');
				
					$('#curso_conteudo').html(data.conteudo);
					//window.location = url;
					
					if (direcao == 'right') {
						$('#curso').css('marginLeft', '100%');
					} else {
						$('#curso').css('marginLeft', '-100%');
					}
					
					$('.loading').hide();

					$('#curso').animate({opacity:1, marginLeft:0 }, 300, function() {
					
						$('#curso').animate({opacity: 1}, 100);
						$('#footer').css({'bottom':0});

						if (data.pontos) {
							showStar(data.pontos);
						}

					});
					
				}
			}
		}); // ajax
	}); // animate opacity	
}

function voce_sabia(acao){
	if(acao==1){
		jQuery('#box_voce_sabia').slideDown('slow',function(){
			window.setTimeout('voce_sabia()',10000);
		});
	}else{
		jQuery('#box_voce_sabia').slideUp('slow');
	}
}

function contar(){
	segundos--;
	if(segundos <= 0){
		window.clearInterval(timerID);
		$('#testefinal').submit();
	}else{
		$('#minutos').text(parseInt(segundos/60)+1);
	}
}

function tocaVideo(id) {
	
	// cria tag para embed do samba player 
	var sambaPlayerScript = document.createElement('script'); 
	sambaPlayerScript.type = 'text/javascript'; 
	sambaPlayerScript.src = 'http://player.sambatech.com.br/current/samba-player.js?playerWidth=640&playerHeight=360&ph=775986ac2445d5c6136a7c05f6798d01&m='+id;
	
	// recupera div videodestaque
	var div = document.getElementById('conteudo_video');
	
	// adiciona novo script do player 
	div.appendChild(sambaPlayerScript);
	
}


function ocultaCamada() { 
	if ($('#anima')[0]) {
		$('#anima').hide();
	}
	if ($('#modalGrade')[0]) {
		$('#modalGrade').hide();
	}
} 

