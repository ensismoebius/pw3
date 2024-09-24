<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cesta de frutas</title>
    <script>
        function mostra(operacao) {
            if(operacao == 0){
                document.getElementById("frutas").style.display="block";
                document.getElementById("codigo").style.display="none";
            }else{
                document.getElementById("frutas").style.display="none";
                document.getElementById("codigo").style.display="block";
            }
        }
    </script>
</head>
<body onload="mostra(0)">
    <form method="post" action="processar3.php">
        <label for="operacao">Operação</label>
        <select name="operacao">
            <option value="0" onclick="mostra(0)">Salvar</option>
            <option value="1" onclick="mostra(1)">Apagar</option>
        </select>
        <hr>
        <div id="codigo" style="diplay:none">
            <label for="codigo">Informe o código para apagar</label>
            <input type="text" name="codigo">
        </div>
        <div id="frutas" style="display:none">
            <label for="fruta[]">Indique suas frutas</label>
            <input type="text" name="fruta[]">
            <input type="text" name="fruta[]">
            <input type="text" name="fruta[]">
        </div>

        <input type="submit" value="enviar">
    </form>
</body>
</html>