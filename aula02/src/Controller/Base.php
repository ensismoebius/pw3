<?php

namespace Etec\Aula02\Controller;

class Base
{
    protected \Twig\Environment $ambiente;
    protected \Twig\Loader\FilesystemLoader $carregador;

    public function __construct()
    {
        $this->carregador = new \Twig\Loader\FilesystemLoader("./src/View");

        $this->ambiente = new \Twig\Environment($this->carregador);

        $this->ambiente->addFunction(
            new \Twig\TwigFunction(
                'asset',
                function ($path) {
                    return 'src/View/' . ltrim($path, '/');
                }
            )
        );
    }
}
