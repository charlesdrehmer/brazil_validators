<?php

namespace CharlesDrehmer;

/**
 * Class TaxIdAbstract
 *
 * Valida e calcula CNPJs e CPFs.
 * Existem no pacote as classes Cpf e Cnpj que a extendem.
 * @package CharlesDrehmer
 */
abstract class TaxIdAbstract {

    /**
     * Tamanho do Campo
     * @var int
     */
    protected $size = 0;
    
    /**
     * Modificadores de Dígitos
     * @var array
     */
    protected $modifiers = array();

    /**
     * Considera vazio válido
     * @var bool
     */
    protected $validIfEmpty = false;

    /**
     * Função para formatar o número
     * @var
     */
    protected $format = [
        "/(.*)/",
        "\$1"
    ];

    /**
     * Validação Interna do Documento
     * @param string $value Dados para Validação
     * @return boolean Confirmação de Documento Válido
     */
    protected function _check($value) {
        return $this->_calculate(mb_substr($value, 0, -2)) === $value;
    }

    protected function _calculate($value) {
        foreach ($this->modifiers as $modifier) {
            $result = 0; // Início do cálculo
            $size = count($modifier); // Número de algarismos dos Modificadores
            for ($i = 0; $i < $size; $i++) {
                $result += $value[$i] * $modifier[$i]; // Somatório
            }
            $result = $result % 11; //Resultado
            $digit = ($result < 2 ? 0 : 11 - $result); // Dígito
            $value .= $digit;
        }
        return $value;
    }

    /**
     * Retorna se o número é válido
     * @param string $value
     * @return bool
     */
    public function isValid(string $value) : bool {
        //Verifica se é vazio
        if (!$this->validIfEmpty && empty($value)) {
            return false;
        }
        // Remove tudo que não for algarismo
        $data = preg_replace('/[^0-9]/', '', $value);
        // Verificação de Tamanho
        if (strlen($data) != $this->size) {
            return false;
        }
        // Verificação de Dígitos Repetidos
        if (str_repeat($data[0], $this->size) == $data) {
            return false;
        }
        // Verificação de Dígitos
        return $this->_check($data);
    }

    /**
     * Calcula o número com seu dígito verificador
     * @param string $value
     * @param bool $formated
     * @return string|null
     */
    public function calculate(string $value, bool $formated = false) : ?string {
        // Remove tudo que não for algarismo
        $data = preg_replace('/[^0-9]/', '', $value);
        // Verificação de Tamanho
        if (strlen($data) != $this->size - 2) {
            return null;
        }
        // Calcula o dígito
        $value = $this->_calculate($value);
        //Se formata
        if($formated) {
            return preg_replace( $this->format[0], $this->format[1], $value);
        }
        //Retorna o resultado
        return $value;
    }

    /**
     * Retorna um número aleatório
     * @param bool $formated
     * @return string
     * @throws \Exception
     */
    public function random(bool $formated = false): string {
        $size = $this->size - 2;
        $value = random_int(1, 10 ** $size - 1);
        $value = sprintf("%0$size" . "d", $value);
        return $this->calculate($value, $formated);
    }

}
