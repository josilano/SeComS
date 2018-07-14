<?php
$dir_root = $_SERVER['DOCUMENT_ROOT'];
define('DIR', $dir_root . '/');
require_once(DIR.'src/api/consulta_correios.php');

class ConsultaAPIController
{
	public function freteCorreios()
	{
		$cepcliente = utf8_encode($_POST['cepcliente']);
		$frete = calculaFrete( 
        '41106', 
        '20081902', 
        $cepcliente, 
        '1', 
        '15', '22', '32', 0 );
        
        return print_r(json_encode($frete));
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method']))
{
	switch ($_POST['method']) {
		case 'fretes':
			return print_r('teste');
			break;
		case 'frete':
			$apic = new ConsultaAPIController;
			$apic->freteCorreios();
			break;
		default:
			# code...
			break;
	}
}