$(document).ready(function() {

	$('#cep_id').mask("99999999");
	$('#cpf_id').mask("99.9999.999-99");
	$('#num_cc').mask("9.99.99.99.99.99.999");
	$('#nascimento_dia,#nascimento_mes').mask('99');
	$('#nascimento_ano').mask('9999');
	$('#telefone_id,#celular_id').mask('(99)9999-9999');
	
	$('#pais_id').change(function() {
		if ($(this).val() == 34) {
			$('#estado_id').show();
			$('#estado_outro').hide();
		} else {
			$('#estado_outro').show();
			$('#estado_id').hide();
		}
	});
	
	$('#cep_id').change(function() {
		if ($('#pais_id').val() == 34) {
			var cep = $(this).val();
			$.ajax({
				type: 'POST'
				,url: PATH_PAINEL+'/_ajax/cadastroCep.php'
				,data: { 'cep' : cep }
				,dataType: 'json'
				,success: function(data) {
					if (data.localidade) {
						$('#endereco_id').val(data.tipo + ' ' + data.logradouro);
						$('#bairro_id').val(data.bairro);
						$('#cidade_id').val(data.localidade);
						$('#estado_id').val(data.id_estado);
					}
				}
			});
		}
	});
	
	$('#link_info_campo_nome').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_nome')
	});	

	$('#link_info_campo_celular').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_celular')
	});	

	$('#link_info_campo_cpf').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_cpf')
	});
	
	$('#link_info_campo_email').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_email')
	});
	
	$('#link_info_campo_dep').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_dep')
	});	
	
	$('#link_info_campo_codigo_cc').qtip({
		position: {
			corner: {
				target: 'rightMiddle',
				tooltip: 'leftMiddle'
	      }
   		},
		style: {
			width:320, 
			name: 'light',
			background: '#FFFFCC'
		},
		content: $('#info_campo_codigo_cc')
	});	

});
