<?php
/**
 * User: LaNo
 */
class Conexaodb
{
    protected $host = "localhost:3306";
    protected $user = "root";
    protected $pass = "";
    protected $banco = "secoms";
    public static $conexao = null;

    public function __construct()
    {
        if (self::$conexao == null)
        {
            self::$conexao = mysqli_connect($this->host, $this->user, $this->pass);
            $db = mysqli_select_db(self::$conexao, $this->banco);
            
            if (!self::$conexao) die("Connection failed: " . mysqli_connect_error());
        }
    }

    public static function getConexao()
    {
        return self::$conexao;
    }
}

function endconection($rs, $conexao){
    mysqli_free_result($rs);
    mysqli_close($conexao);
}
?>