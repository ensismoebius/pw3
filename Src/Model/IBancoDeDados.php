<?php

namespace Src\Model;

interface IBancoDeDados {

    public function getCampos(): array;

    public function getValores(): array;
}
