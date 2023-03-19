<?php
// ** restringe o acesso: concede ou nega **
function isAuthorized($strUsers, $strGroups, $UserRA, $UserGroup)
{
	$isValid = False;
	if (!empty($UserRA)) {
		$arrUsers = Explode(",", $strUsers);
		$arrGroups = Explode(",", $strGroups);
		if (in_array($UserRA, $arrUsers)) {
			$isValid = true;
		}
		if (in_array($UserGroup, $arrGroups)) {
			$isValid = true;
		}
		if (($strUsers == "") && true) {
			$isValid = true;
		}
	}
	return $isValid;
}

function limpaValores($valor)
{
	$valor = trim($valor);
	$valor = str_replace(".", "", $valor);
	$valor = str_replace(",", "", $valor);
	$valor = str_replace("-", "", $valor);
	$valor = str_replace("(", "", $valor);
	$valor = str_replace(")", "", $valor);
	return $valor;
}

function mask($val, $mask)
{
	$maskared = '';
	$k = 0;
	for ($i = 0; $i <= strlen($mask) - 1; $i++) {
		if ($mask[$i] == '#') {
			if (isset($val[$k]))
				$maskared .= $val[$k++];
		} else {
			if (isset($mask[$i]))
				$maskared .= $mask[$i];
		}
	}
	return $maskared;
};

function loop($a, $b, $c, $d, $e, $f, $g)
{
	$a = new DateTime($b);
	$c = new DateTime($d);
	$e = $a->diff($c);
	$f += $e->i;
	$g = $f / 60;
	$g = number_format($g, 2, '.', '');
	return $a;
	$b;
	$c;
	$d;
	$e;
	$f;
	$g;
}

function formatar($x)
{
	if ($x == '') {
		$x = 'R$ 0,00';
	} else {
		$x = 'R$ ' . number_format($x, 2, ',', '.');
	}
	echo $x;
}

/*Função para remover caracteres não numéricos*/
function clear_text($str)
{
	return preg_replace("/[^0-9]/", "", $str);
}
