<?php 
require_once(DIR.'src/dao/Produtodao.class.php');

class Produto
{
	private $id;
	private $nome;
	private $descricao;
	private $preco;
	private $url_img;
	private $created_at;
	private $updated_at;
	protected $dao;

	public function __construct()
	{
		$this->dao = new Produtodao();
	}

	public function getNome()
	{
		return $this->nome;
	}

	public function setNome($nome)
	{
		$this->nome = $nome;
	}

	public function getDescricao()
	{
		return $this->descricao;
	}

	public function setDescricao($descricao)
	{
		$this->descricao = $descricao;
	}

	public function getPreco()
	{
		return $this->preco;
	}

	public function setPreco($preco)
	{
		$this->preco = $preco;
	}

	public function getUrlimg()
	{
		return $this->url_img;
	}

	public function setUrlimg($url_img)
	{
		$this->url_img = $url_img;
	}

	public function cadastra(Produto $produto)
	{
		return $this->dao->save($produto);
	}

	public function listar()
	{
		return $this->dao->all();
	}

	public function listaComPromocao()
	{
		return $this->dao->anuncios();
	}

	public function buscar($id)
	{
		return $this->dao->find($id);
	}

	public function anuncio($id)
	{
		return $this->dao->anuncio($id);
	}

	public function atualizaUpdated($id)
	{
		return $this->dao->atualizarUpdated($id);
	}

	public function cadastraPromocao($produto_id, $preco_promocional, $data_inicio, $data_fim)
	{
		return $this->dao->savePromocao($produto_id, $preco_promocional, $data_inicio, $data_fim);
	}
}