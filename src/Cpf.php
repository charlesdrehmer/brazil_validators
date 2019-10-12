<?php

namespace CharlesDrehmer;

/**
 * Class Cpf
 *
 * @package CharlesDrehmer
 */
class Cpf extends TaxIdAbstract {

    /**
     * Tamanho do Campo
     * @var int
     */
    protected $size = 11;

    /**
     * Modificadores de Dígitos
     * @var array
     */
    protected $modifiers = [
        [10, 9, 8, 7, 6, 5, 4, 3, 2],
        [11, 10, 9, 8, 7, 6, 5, 4, 3, 2]
    ];

    /**
     * Formatação do Cpf
     * @var array
     */
    protected $format = [
        "/(\d{3})(\d{3})(\d{3})(\d{2})/",
        "\$1.\$2.\$3-\$4"
    ];
}
