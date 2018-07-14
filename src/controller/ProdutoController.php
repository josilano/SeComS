<?php
$dir_root = $_SERVER['DOCUMENT_ROOT'];
define('DIR', $dir_root . '/');
require_once(DIR.'src/model/Produto.class.php');


class ProdutoController
{

	public function cadastra()
	{
		$nome = $_POST['nome'];
		$descricao = $_POST['descricao'];
		$preco = number_format((double)str_replace(',', '.', str_replace('.', '', $_POST['preco'])), 2, '.', '');
		$url_img = $_POST['url_img'];

		$produto = new Produto();
		$produto->setNome($nome);
		$produto->setDescricao($descricao);
		$produto->setPreco($preco);
		$produto->setUrlimg($url_img);
		
		if ($produto->cadastra($produto)) return $produto;
	}

	public function lista()
	{
		$produto = new Produto();
		$produtos = $produto->listar();
		return $produtos;
	}

	public function busca($id)
	{
		$p = new Produto();
		return $p->buscar($id);
	}

	public function listaPromocao()
	{
		$p = new Produto();
		return $p->listaComPromocao();
	}

	public function anuncio($id)
	{
		$p = new Produto();
		return $p->anuncio($id);
	}

	public function finalizaCompra()
	{
		$to = 'email_para_envio@hotmail.com';
		$subject = 'Pedido de compra';
		$message = 'Nome do cliente: '. $_POST['nomecliente'] .', idProduto: ,e-mailCliente: '. $_POST['emailcliente'];
		$headers = 'From: secoms@hotmail.com';
		ini_set('SMTP', 'smtp.live.com');
		ini_set('sendmail_from', $to);
		$sendemail = mail($to, $subject, $message, $headers);
		return print_r($sendemail);
	}

	public function addPromocao()
	{
		$data_inicio = $_POST['data_inicio'];
		$data_fim = $_POST['data_fim'];
		$produto_id = $_POST['produto_id'];
		$preco_promocional = number_format((double)str_replace(',', '.', str_replace('.', '', $_POST['preco_promocional'])), 2, '.', '');
		$data_inicio = utf8_encode(strftime('%y-%d-%m', strtotime($data_inicio)));
		$data_fim = utf8_encode(strftime('%y-%d-%m', strtotime($data_fim)));
		
		$produto = new Produto();
		
		if ($produto->cadastraPromocao($produto_id, $preco_promocional, $data_inicio, $data_fim))
			if ($produto->atualizaUpdated($produto_id)) return true;
		return false;
	}
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['method']))
{
	switch ($_POST['method']) {
		case 'upload':
			// Recuperando imagem em base64
			// Exemplo: data:image/png;base64,AAAFBfj42Pj4
			$imagem = $_POST['imagem'];

			// Separando tipo dos dados da imagem
			// $tipo: data:image/png
			// $dados: base64,AAAFBfj42Pj4
			list($tipo, $dados) = explode(';', $imagem);

			// Isolando apenas o tipo da imagem
			// $tipo: image/png
			list(, $tipo) = explode(':', $tipo);

			// Isolando apenas os dados da imagem
			// $dados: AAAFBfj42Pj4
			list(, $dados) = explode(',', $dados);

			// Convertendo base64 para imagem
			$dados = base64_decode($dados);

			// Gerando nome aleatório para a imagem
			$nome = md5(uniqid(time()));

			// Salvando imagem em disco
			file_put_contents("../../pictures/{$nome}.jpg", $dados);
			if ($_POST['fotoold'] != 'port1.jpg') unlink("../../pictures/" . $_POST['fotoold']);

			return print_r($nome . '.jpg');
			break;
		case 'cadastra':
			$produtoc = new ProdutoController;
			$produtoc->cadastra();
			echo $_POST['method'];die;
			break;
		case 'lista':
			$produtoc = new ProdutoController;
			$produtoc->lista();
			break;	
		case 'finalizacompra':
			$produtoc = new ProdutoController;
			$produtoc->finalizaCompra();
			break;	
		case 'addpromocao':
			$produtoc = new ProdutoController;
			$produtoc->addPromocao();
			break;	
		default:
			# code...
			break;
	}
}