<?php
//require_once('../connectionfactory/Conexaodb.class.php');

require_once(DIR.'src/connectionfactory/Conexaodb.class.php');

class Produtodao
{
	public function save(Produto $produto)
	{
		$conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    date_default_timezone_set('America/Fortaleza');
    $sql = "insert into produtos (nome, descricao, preco, url_img, created_at, updated_at)".
      " VALUES ('" . $produto->getNome() . "', '" . $produto->getDescricao() . "', '" . $produto->getPreco() . "', '". $produto->getUrlimg() . "','" . date('y-m-d H:i:s') . "', '" . date('y-m-d H:i:s') . "')";

    if (mysqli_query($conexao, $sql))
        echo "gravado no banco";
    else
        echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    return true;

	}

  public function all()
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    date_default_timezone_set('America/Fortaleza');
    $sql = "select * from produtos order by updated_at";
    //$rs = mysqli_query($conexao, $sql);
    
    //$reg = mysqli_fetch_array($rs);

    if ($rs = mysqli_query($conexao, $sql))
    {
      $i = 0;
      while ($reg = mysqli_fetch_array($rs))
      {
        $list[$i] = [
            'id' => $reg['id'],
            'nome' => utf8_encode($reg['nome']),
            'preco' => $reg['preco'],
            'descricao' => $reg['descricao'],
            'url_img' => $reg['url_img'],
            'created_at' => $reg['created_at'],
            'updated_at' => $reg['updated_at']
            //'cargo' => utf8_encode(utf8_decode($reg['cargo']))
        ];
        $i++;
      }
      return $list;
    }
    else echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
  }

  public function find($id)
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    $sql = "select * from produtos where id = " . $id;
    $rs = mysqli_query($conexao, $sql);
    $reg = mysqli_fetch_array($rs);
    $produto = array(
      'id' => $reg['id'],
      'nome' => utf8_encode($reg['nome']),
      'preco' => $reg['preco'],
      'descricao' => $reg['descricao'],
      'url_img' => $reg['url_img'],
      'created_at' => $reg['created_at'],
      'updated_at' => $reg['updated_at']
    );
    return $produto;
  }

  public function saveas($tablename, $objetomodel)
  {
    foreach ($objetomodel as $c => $v) {
      # code...
    }
    $sql = "insert into". $tablename . "(tipo, numprocesso, dataprocesso, nome, matricula, sexo, cargo, 
      dataefeitos, classeatual, classenova, dataavalinicial, dataavalfinal, dataportaria) VALUES ('$tipo', 
      '$numprocesso', '$dataprocesso', '$nome', '$matricula', '$sexo', '$cargo', '$dataEfeitos', '$classeAtual', 
      '$classeNova', '$perAvalInicial', '$perAvalFinal', '$dataportaria')";
  }

	public function teste()
	{
    date_default_timezone_set('America/Fortaleza');
    print_r(date('d-m-y H:i:s'));die;
    $conexao = new Conexaodb();
    print_r($conexao);
    return print_r($conexao->getConexao());
	}

  public function anuncios()
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    date_default_timezone_set('America/Fortaleza');
    $hoje = date('Y-m-d');
    $sql = "select p.id, p.nome, p.descricao, p.preco, p.url_img, p.updated_at, promo.preco_promocional FROM produtos AS p LEFT JOIN promocoes AS promo ON p.id = promo.produto_id AND promo.data_inicio <= '". $hoje . "' AND promo.data_fim >= '". $hoje ."' GROUP BY p.id ORDER BY p.updated_at DESC";
    //$sql = "select * FROM produtos AS p LEFT JOIN promocoes AS promo ON p.id = promo.id AND promo.data_inicio <= '". $hoje ."' AND promo.data_fim >= '". $hoje ."' GROUP BY p.id ORDER BY p.updated_at DESC";
    
    if ($rs = mysqli_query($conexao, $sql))
    {
      $i = 0;
      while ($reg = mysqli_fetch_array($rs))
      {
        $list[$i] = [
            'id' => $reg['id'],
            'nome' => utf8_encode($reg['nome']),
            'preco' => $reg['preco'],
            'descricao' => $reg['descricao'],
            'url_img' => $reg['url_img'],
            'updated_at' => $reg['updated_at'],
            'preco_promocional' => $reg['preco_promocional']
        ];
        $i++;
      }
      return $list;
    }
    else echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
  }

  public function anuncio($id)
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    $sql = "select id, nome, preco, descricao, url_img from produtos where id = " . $id;
    $rs = mysqli_query($conexao, $sql);
    $reg = mysqli_fetch_array($rs);
    $produto = array(
      'id' => $reg['id'],
      'nome' => utf8_encode($reg['nome']),
      'preco' => $reg['preco'],
      'descricao' => $reg['descricao'],
      'url_img' => $reg['url_img'],
      'preco_promocional' => null
    );
    date_default_timezone_set('America/Fortaleza');
    $hoje = date('Y-m-d');
    $sql = "select preco_promocional from promocoes where produto_id = ". $id ." and data_inicio <= '". $hoje . "' AND data_fim >= '". $hoje ."'";
    $rs = mysqli_query($conexao, $sql);
    $reg = mysqli_fetch_array($rs);
    $produto['preco_promocional'] = $reg['preco_promocional'];
    return $produto;
    $sql = "select p.id, p.nome, p.preco, p.descricao, promo.preco_promocional, promo.data_inicio, promo.data_fim FROM produtos AS p INNER JOIN promocoes AS promo ON p.id = promo.produto_id AND p.id = ". $id;
  }

  public function atualizarUpdated($id)
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    date_default_timezone_set('America/Fortaleza');
    $sql = "update produtos set updated_at = '" . date('Y-m-d H:i:s') . "' where id = " . $id . "";
    $rs = mysqli_query($conexao, $sql);
    if (!$rs)
      echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    return $rs;
  }

  public function savePromocao($produto_id, $preco_promocional, $data_inicio, $data_fim)
  {
    $conexao = new Conexaodb();
    $conexao = $conexao->getConexao();
    date_default_timezone_set('America/Fortaleza');
    $hoje = date('y-m-d H:i:s');
    $sql = "insert into promocoes (produto_id, preco_promocional, data_inicio, data_fim, created_at, updated_at)".
      " VALUES ('" . $produto_id . "', '". $preco_promocional . "', '" . $data_inicio . "', '" . $data_fim . "', '" . $hoje . "', '" . $hoje . "')";
    $rs = mysqli_query($conexao, $sql);
    if ($rs) echo "gravado no banco";
    else echo "Erro: " . $sql . "<br>" . mysqli_error($conexao);
    return $rs;
  }
}