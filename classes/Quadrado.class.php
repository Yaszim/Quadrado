<?php
require_once("../classes/Database.class.php");
require_once("Unidade.class.php");

class Quadrado
{
    private $id;
    private $lado;
    private $cor;
    private $unidade;

    public function __construct($id = 0, $lado = 1, $cor = "", Unidade $unidade = null)
    {
        $this->setId($id);
        $this->setLado($lado);
        $this->setCor($cor);
        $this->setUnidade($unidade);

    }

    public function setId($id)
    {
        if ($id < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id = $id;
    }

    public function setLado($lado)
    {
        if ($lado < 1)
            throw new Exception("Erro, número indefinido");
        else
            $this->lado = $lado;
    }

    public function setCor($cor)
    {
        if ($cor == "")
            throw new Exception("Erro, cor indefinido");
        else
            $this->cor = $cor;
    }

    public function setUnidade($unidade)
    {
        if (!$unidade)
            throw new Exception("Erro, unidade indefinida");
        else
            $this->unidade = $unidade;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLado()
    {
        return $this->lado;
    }

    public function getCor()
    {
        return $this->cor;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function incluir()
    {
        $sql = 'INSERT INTO quadrados (lado, cor,id_un)   
                VALUES (:lado, :cor, :unidade)';

        $parametros = array(':lado' => $this->lado, ':cor' => $this->cor, ':unidade' => $this->unidade->getId());
        return Database::executar($sql, $parametros);
    }

    public function excluir()
    {
        $conexao = Database::getInstance();
        $sql = 'DELETE FROM quadrados WHERE id = :id';
        $comando = $conexao->prepare($sql);
        $comando->bindValue(':id', $this->id);
        return $comando->execute();
    }

    public function alterar()
    {
        $sql = 'UPDATE quadrados
                SET lado = :lado, cor = :cor, id_un = :unidade, id = :id
                WHERE id = :id';
        $parametros = array(':lado' => $this->lado, ':cor' => $this->cor, ':unidade' => $this->unidade, ':id' => $this->id);
        return Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = "")
    {
        $sql = "SELECT * FROM quadrado.quadrados";
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
                    $sql .= " WHERE id_un LIKE :busca";
                    $busca = "%{$busca}%";
                    break;
            }
        }
        // $comando = $conexao->prepare($sql);
        $parametros = [];
        if ($tipo > 0)
            $parametros = array(':busca' => $busca);

        $comando = Database::executar($sql, $parametros);
        $quadrados = array();

        while ($forma = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = Unidade :: listar(1,$forma['id_un'])[0]; 
            $quadrado = new Quadrado($forma['id'], $forma['lado'], $forma['cor'], $unidade);
            array_push($quadrados, $quadrado);
        }
        return $quadrados;
    }

    public function desenharQuadrado()
    {
        return "<div class='quadrado' style='width:{$this->getLado()}{$this->getUnidade()->getUnidade()};height:{$this->getLado()}{$this->getUnidade()->getUnidade()};background-color:{$this->getCor()};'></div>";    }
}
