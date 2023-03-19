function nl2br (str, is_xhtml) {
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function htmlEntities(texto){
	var i,carac,letra,novo='';
	for(i=0;i<texto.length;i++){
		carac = texto[i].charCodeAt(0);
		if( (carac > 47 && carac < 58) || (carac > 62 && carac < 127) ){
			novo += texto[i];
		}else{
			novo += "&#" + texto[i].charCodeAt(0) + ";";
		}
	}
	return novo;
}

var caption = '';
var char = 0;
var pergunta = '';
var data_atual = new Date();

function type() {	
	$('.text_tooltip').html(caption.substr(0, char++));
	if(char < caption.length+1)
		setTimeout("type()", 40);
	else {
		char = 0;
		caption = "";
	}
}


$(document).ready(function() {

	if ($('.checks')[0]) {
		$('.checks td input').click(function() {
			var $input = $(this);
			$input.attr('checked', !$input.attr('checked'));
			$(this).parent().toggleClass('check');
		});
		$('.checks td').click(function() {
			var $input = $(this).parent().children('td:eq(0)').children('input');
			$input.attr('checked', !$input.attr('checked'));
			$(this).parent().toggleClass('check');
		});
	}
	
	$('.checks td input:checked').each(function() {
		$(this).parent().addClass('check');
	});

	$('.response_friend').live('click', function() {
		var $t = $(this);
		var $parent = $t.parent('div:eq(0)');
		var content = $parent.html();
		
		if ($t.attr('rel').split('-')[1] == '1') {
			var msg = '<img src="'+PATH_PAINEL+'/_img/tick.png" width="16" height="16" style="margin-right:3px;"/> Pedido aceito';
		} else {
			var msg = 'Pedido recusado';
		}
		
		$.ajax({
			type: 'POST'
			,url: PATH_PAINEL+'/_ajax/amizadeStatus.php'
			,data: { 'id_amigo' : $t.attr('rel').split('-')[0], 'status' : $t.attr('rel').split('-')[1] }
			,dataType: 'json'
			,success: function(data) {
				$parent.html('<div style="padding-top:5px">' + msg + '</div>');
			}
		});

		return false;
	});

	$('.fancy').click(function() {
		var href = $(this).attr('href');
		$.fancybox({
			href: href + '&popup=1'
			,type: 'iframe'
			,width:880
			,height:550
		});
		return false;
	});

});


function showStar(pontos) {
	$('#star').remove();

	var $_star = $('<div id="star" style="display:none;overflow:hidden;width:140px;height:136px;padding-top:2.8rem;text-align:center;font-size:2rem;letter-spacing:-4px;font-weight:bold;position:absolute;margin:auto;top:0;right:0;bottom:0;left:0;margin-bottom:30px;background:transparent url(/orc/_img/icon-star.png?) no-repeat;"></div>').appendTo('body');

	pontos = parseInt(pontos);
	if (pontos < 0) {
		var _color = '#FF0400';
	} else {
		var _color = '#555';
		pontos = '+' + pontos;
	}

	if (pontos < 0) {
		var _audio_src = '/orc/_img/som-pontos1.mp3';
	} else {
		var _audio_src = '/orc/_img/som-pontos2.mp3';
	}

	var $_audio = $('<audio/>');
	$_audio.attr('src', _audio_src);
	$_audio.attr('autoplay', 'autoplay');

	$_audio.load(function() {
		$_audio.play();
	});

	$_star.html('<span style="color:' + _color + '">' + pontos + '</span>');
	$_star.fadeIn('fast', function() {
		for(i=0;i<2;i++) {
			$_star.fadeTo('fast', 0.4).fadeTo('fast', 1.0);
		}
		$_star.delay(500).animate({right:'-1200px','margin-top':'-1000px',opacity:0}, 700, "swing", function() {
			$_star.remove();
			$_audio.remove();
		});
	});
}

//minha
		var count=new Number();
		var count=5;
		function start(url){
			if((count - 1) >= 0){
				count = count -1;
				if (count==0){
					parent.window.location=this.href=url;
					return false;
				}else if (count <10){
					count = "0"+count;			
				}
				tempo.innerText = "Redirecionando em "+count+" seg.";
				setTimeout('start(\''+url+'\');',1000);
			}
		}
	
function FormataValor(id,tammax,teclapres) {
    
        if(window.event) { // Internet Explorer
         var tecla = teclapres.keyCode; }
        else if(teclapres.which) { // Nestcape / firefox
         var tecla = teclapres.which;
        }
    
 
vr = document.getElementById(id).value;
vr = vr.toString().replace( "/", "" );
vr = vr.toString().replace( "/", "" );
vr = vr.toString().replace( ",", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
vr = vr.toString().replace( ".", "" );
tam = vr.length;
 
if (tam < tammax && tecla != 8){ tam = vr.length + 1; }
 
if (tecla == 8 ){ tam = tam - 1; }
 
if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ){
if ( tam <= 2 ){
document.getElementById(id).value = vr; }
if ( (tam > 2) && (tam <= 5) ){
document.getElementById(id).value = vr.substr( 0, tam - 2 ) + ',' + vr.substr( tam - 2, tam ); }
if ( (tam >= 6) && (tam <= 8) ){
document.getElementById(id).value = vr.substr( 0, tam - 5 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); }
if ( (tam >= 9) && (tam <= 11) ){
document.getElementById(id).value = vr.substr( 0, tam - 8 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); }
if ( (tam >= 12) && (tam <= 14) ){
document.getElementById(id).value = vr.substr( 0, tam - 11 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam ); }
if ( (tam >= 15) && (tam <= 17) ){
document.getElementById(id).value = vr.substr( 0, tam - 14 ) + '.' + vr.substr( tam - 14, 3 ) + '.' + vr.substr( tam - 11, 3 ) + '.' + vr.substr( tam - 8, 3 ) + '.' + vr.substr( tam - 5, 3 ) + ',' + vr.substr( tam - 2, tam );}
}
}

/*
function showTimer() { 
	var time=new Date(); 
	var hour=time.getHours(); 
	var minute=time.getMinutes(); 
	var second=time.getSeconds();
	if(hour<10) hour ="0"+hour; 
	if(minute<10) minute="0"+minute; 
	if(second<10) second="0"+second;
	var st=hour+":"+minute+":"+second; 
	document.getElementById('timer').innerHTML=st; 
	
	
}

function initTimer() { 
	// O metodo nativo setInterval executa uma determinada funcao em um determinado tempo 
	setInterval(showTimer,1000);  
}*/

//ano spinner
$("#ano_vigente").click(function () {
	document.getElementById('sp_1').style.display = "none";
	document.getElementById('sp_2').style.display = "inline";
});

$("#cancel_ano").click(function () {
	document.getElementById('sp_1').style.display = "inline";
	document.getElementById('sp_2').style.display = "none";			   
});
			
$("#set_ano").click(function () {
	var result = document.getElementById('spinner').value;			   
	document.getElementById('sp_1').style.display = "inline";
	document.getElementById('sp_2').style.display = "none";
	document.getElementById('ano_vigente').innerHTML = result;
	$.ajax({
			type: 'POST'
			,url: PATH_PAINEL+'/_ajax/update_ano_vig.php'
			,data: { 'ano_vig' : result }			
	});
	//setTimeout('location.reload();', 10);		   
	location.reload();
});
//ano spinner fecha