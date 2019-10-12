<?php

namespace CharlesDrehmer;

/**
 * Class Cnpj
 *
 * @package CharlesDrehmer
 */
class Cnpj extends TaxIdAbstract {

    /**
     * Tamanho do Campo
     * @var int
     */
    protected $size = 14;

    /**
     * Modificadores de Dígitos
     * @var array
     */
    protected $modifiers = [
        [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2],
        [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2]
    ];

    /**
     * Formatação do Cnpj
     * @var array
     */
    protected $format = [
        "/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/",
        "\$1.\$2.\$3/\$4-\$5"
    ];
}
