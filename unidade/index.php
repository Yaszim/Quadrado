<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Quadrado</title>
</head>

<body>
<fieldset>
   
                    <a class="nav-link" href="../quadrado/index.php">Cadastro de Quadrado</a>
                    <a class="nav-link active" aria-current="page" href="#">Cadastro de Unidade</a>

    
        <form action="unidade.php" method="post">

  
                    <h4> <b>Cadastro de Unidade</b></h4>
       

        
                    <label for="id">ID</label>
                    <input class="form-control" type="text" name="id" id="id" value="0" readonly>
          
                    <label for="id">Unidade</label>
                    <input class="form-control" type="text" name="unidade" id="unidade">
         

        
                    <input type="submit" name="acao" id="acao" value="Salvar">
               
                    <input type="reset" name="resetar" id="resetar" value="Resetar">
            
        </form>
        </fieldset>
        <form action="unidade.php" method="post">

         
                    <h4> <b>Busca</b></h4>
          

                    <input class="form-control" type="text" name="busca" id="busca" placeholder="Busca">
            
                    <select class="form-select" name="tipo" id="tipo">
                        <option value="1">ID</option>
                        <option value="4">Unidade</option>
                    </select>
            
         
                    <input type="submit" name="acao" id="acao" value="Buscar">
          


        </form>
   
</body>

</html>