<?php

use CharlesDrehmer\Cnpj;
use CharlesDrehmer\Cpf;

require __DIR__ . '/vendor/autoload.php';

$testeCNPJ = new Cnpj();
$testeCPF = new Cpf();

print $testeCPF->random(true) . "\n";
print $testeCNPJ->random(true) . "\n";
