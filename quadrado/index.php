<!DOCTYPE html>
<html lang="en">
<?php
include_once('quadrado.php');
?>

<head>

    <title>Criação de quadrado</title>
</head>

<body>

        <a class="nav-link active" aria-current="page" href="#">Cadastro de Quadrado</a>
        <a class="nav-link" href="../unidade/index.php">Cadastro de Unidade</a>

        <form action="quadrado.php" method="post">

            <h4> <b>Cadastro de Quadrado</b></h4>

<fieldset>

                    <label for="lado">Altura</label>
                    <input type="number" name="lado" id="lado" value="<?= $id ? $quadrado->getLado() : 0 ?>" placeholder=" Digite a lado de sua forma">
                    <label for="cor">Cor</label>
                    <input type="color" name="cor" id="cor" placeholder=" Digite a cor de sua forma" value="<?= $id ? $quadrado->getCor() : "black" ?>">
                    <label  for="unidade">Unidade</label>
                    <select  name="unidade" id="unidade">
                    <?php  
                        $unidades = Unidade::listar(0);
                        foreach($unidades as $unidade){ 
                            $str = "<option value='{$unidade->getId()}'";
                            if(isset($forma)) 
                                if ($forma->getUnidade()->getId() == $unidade->getId())
                                    $str .= " selected";
                                $str .= ">{$unidade->getUnidade()}</option>";
                                echo $str;
            }     
        ?>
                    </select>
                    <input type="text" name="id" id="id" value="<?= isset($quadrado) ? $quadrado->getId() : 0 ?>"  hidden>

                    <input type="submit" name="acao" id="acao" value="Salvar">
                    <input type="submit" name="acao" id="acao" value="Excluir">
                    <input type="submit" name="acao" id="acao" value="Alterar">

        </form>
</fieldset>
        <form action="" method="get">

                    <h4><b>Busca</b></h4>


                    <input type="text" name="busca" id="busca" placeholder="Busca">

                    <select name="tipo" id="tipo">
                        <option value="1">ID</option>
                        <option value="2">Lado</option>
                        <option value="3">Cor</option>
                        <option value="4">Unidade</option>
                    </select>

                    <input type="submit" name="acao" id="acao" value="Buscar">


        </form>
        <table>
            <thead>
                <th>Id</th>
                <th>Lado</th>
                <th>Cor</th>
                <th>Unidade</th>
                <th>Quadrados</th>
            </thead>

            <?php
            foreach ($lista as $quadrado) {
                echo "<tr><td><a href='index.php?id=".$quadrado->getId()."'>".$quadrado->getId()."</a></td><td>".$quadrado->getLado()."</td><td>".$quadrado->getCor()."</td><td>".$quadrado->getUnidade()->getUnidade(). $quadrado->desenharQuadrado()."</td><td>";
            }

            ?>
        </table>
</body>

</html>