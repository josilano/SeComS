<?php
/**
 * Created by PhpStorm.
 * User: LaNo
 * Date: 27/02/2017
 * Time: 19:33
 */
//root13 porta 3306 do mysql mysqlroot windows service name: MySQL57
class Conexaodb
{
    protected $host = "localhost:3306";
    protected $user = "root";
    protected $pass = "";
    protected $banco = "secoms";
    public static $conexao = null;

    public function __construct()
    {
        //echo 'entrou conexaodb<br>';
        if (self::$conexao == null)
        {
            self::$conexao = mysqli_connect($this->host, $this->user, $this->pass);
            $db = mysqli_select_db(self::$conexao, $this->banco);
            //echo 'criou con';
            if (!self::$conexao) die("Connection failed: " . mysqli_connect_error());
        }
    }

    public static function getConexao()
    {
        return self::$conexao;
    }
}


/**
if ($conexao)
    echo 'conexao ok<br>';
else
    die('sem conexao ' . mysqli_error());

if ($db)
    echo 'conectado<br>';
else
    die('sem banco: ' . mysqli_error());

$sql = "select * from servidores";

$rs = mysqli_query($conexao, $sql);

$reg = mysqli_fetch_array($rs);

while ($reg = mysqli_fetch_array($rs)){
    echo $matricula = $reg["matricula"] . " ";
    echo $nome = $reg['nome'] . " ";
    echo $sexo = $reg['sexo'] . " ";
    echo $cargo = $reg['cargo'] . "<br>";
    //print $matricula . "<br>";
}

foreach ($reg as $servidor) {
    $matricula = $servidor["matricula"];
    $nome = $servidor['nome'];
    $sexo = $servidor['sexo'];
    $cargo = $servidor['cargo'];
    echo $matricula;
}
*/

function endconection($rs, $conexao){
    mysqli_free_result($rs);
    mysqli_close($conexao);
}
?>