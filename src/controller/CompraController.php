<?php
$dir_root = $_SERVER['DOCUMENT_ROOT'];
define('DIR', $dir_root . '/');
require_once(DIR.'src/email/envioemailphpmailer.php');

class CompraController
{
	public function finalizaCompra()
	{
		
		$emailDe = $_POST['emailcliente'];
		$nomeDe = $_POST['nomecliente'];
		$emailPara = 'email_destino_compra@gmail.com';
		$nomePara = 'SeComS Compra';
		$assunto = 'Pedido de compra';
		$conteudo = '<h4>Pedido de Compra</h4>Cliente: <b>'. $nomeDe .'</b><br>e-mail: <b>'. $emailDe .'</b><br>Produto id: <b>'. $_POST['produto_id'] .'</b><br>CEP: <b>'. $_POST['cepcliente'] .'</b>';
		enviarEmail($emailDe, $nomeDe, $emailPara, $nomePara, $assunto, $conteudo);

		return print_r('enviado');
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method']))
{
	switch ($_POST['method']) {
		case 'finalizacompra':
			$comprac = new CompraController;
			$comprac->finalizaCompra();
			break;
		default:
			# code...
			break;
	}
}