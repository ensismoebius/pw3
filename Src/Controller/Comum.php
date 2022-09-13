<?php

namespace Src\Controller;

class Comum {

    public function principal(array $param) {
        echo "Olá rota!";
    }

    public function entreEmContato(array $param) {
        echo "<form><input type='submit' value='enviar'/> </form>";
        echo "<p>" . $param["gerente"] . "</p>";
    }

}
