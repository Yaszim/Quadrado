<?php
require_once("../classes/Database.class.php");

class Unidade
{
    private $id;
    private $unidade;

    public function  __construct($id = 0, $unidade = 1)
    {
        $this->setId($id);
        $this->setUnidade($unidade);
    }

    public function setId($id)
    {
        if ($id < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id = $id;
    }


    public function setUnidade($unidade)
    {
        if ($unidade == 0)
            throw new Exception("Erro, unidade indefinida");
        else
            $this->unidade = $unidade;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function incluir()
    {
        $sql = 'INSERT INTO unidademedida (id, unidade)   
                VALUES (:id, :unidade)';

        $parametros = array(':id' => $this->id, ':unidade' => $this->unidade);
        return Database::executar($sql, $parametros);
    }

    public function excluir()
    {
        $conexao = Database::getInstance();
        $sql = 'DELETE FROM unidademedida WHERE id = :id';
        $comando = $conexao->prepare($sql);
        $comando->bindValue(':id', $this->id);
        return $comando->execute();
    }

    public function alterar()
    {
        $sql = 'UPDATE unidademedida
                SET unidade = :unidade, id = :id
                WHERE id = :id';
        $parametros = array( ':unidade' => $this->unidade, ':id' => $this->id);
        return Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = "")
    {
        $sql = "SELECT * FROM quadrado.unidademedida";
        if ($tipo > 0) {
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE id = :busca";
                    break;
                case 2:
                    $sql .= " WHERE lado LIKE :busca";
                    $busca = "%{$busca}%";
                    break;
                case 3:
                    $sql .= " WHERE cor LIKE :busca";
                    $busca = "%{$busca}%";
                    break;
                case 4:
                    $sql .= " WHERE unidade LIKE :busca";
                    $busca = "%{$busca}%";
                    break;
            }
        }
        // $comando = $conexao->prepare($sql);
        $parametros = [];
        if ($tipo > 0)
            $parametros = array(':busca' => $busca);

        $comando = Database::executar($sql, $parametros);
        $unidades = array();

        while ($forma = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = new Unidade($forma['id'], $forma['unidade']);
            array_push($unidades, $unidade);
        }
        return $unidades;
    }

}
