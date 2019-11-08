<?php

/* checkValue recebe um número (em algorismo romano) e retorna seu valor arábico
caso seja válido */
function checkValue($x) {
    $n = romanToArabic($x);
    if ($n > 999 or $n < 1) {
        throw new Exception('A calculadora só pode operar com números de entrada e saída menores que 1000 e maiores que 0! Foi mal!');
    }
    return $n;
}

/* evaluate recebe dois inteiros, $p e $q, e retorna o resultado da operação $op 
aplicada sobre eles */
function evaluate($p, $q, $op) {
    switch ($op) {
        case "+":
            return arabicToRoman($p+$q);
            break;
        case "-":
            return arabicToRoman($p-$q);
            break;
        case "*":
            return arabicToRoman($p*$q);
            break;
        case "/":
            return arabicToRoman($p/$q);
            break;
        default:
            return "invalid operation";
    }
}

/* romanToArabic recebe um algarismo romano $romanNum e retorna seu 
corresponte em arábico */
function romanToArabic($romanNum) {
    $converterTable = array(
        1 => 'I',
        4 => 'IV',
        5 => 'V',
        9 => 'IX',
        10 => 'X',
        40 => 'XL',
        50 => 'L',
        90 => 'XC',
        100 => 'C',
        400 => 'CD',
        500 => 'D',
        900 => 'CM',
        1000 => 'M'
    );
    $chars = str_split($romanNum);
    $n = 0;
    reset($chars);
    while(key($chars) !== null and $n < 1000) {
        $cur = $chars[key($chars)];
        next($chars);
        // concatenacao $cur.$chars[key($chars)]
        $arabic = array_search($cur.$chars[key($chars)], $converterTable);
        if ($arabic) {
            $n += $arabic;
        }
        else {
            prev($chars);
            $arabic = array_search($chars[key($chars)], $converterTable);
            $n += $arabic;
        }
        next($chars);
    }
    return $n;
}

/* arabicToRoman recebe um algarismo arábico $x e retorna seu 
corresponte algarismo romano */
function arabicToRoman($x) {
    $r = '';
    $converterTable = array(
        1 => 'I',
        4 => 'IV',
        5 => 'V',
        9 => 'IX',
        10 => 'X',
        40 => 'XL',
        50 => 'L',
        90 => 'XC',
        100 => 'C',
        400 => 'CD',
        500 => 'D',
        900 => 'CM',
        1000 => 'M'
    );
    while ($x > 0) {
        // find the highest decimal value
        reset($converterTable);
        while(key($converterTable) !== null && $x >= key($converterTable)) {
            next($converterTable);
        };
        $v = prev($converterTable);
        $r .= $v;
        $x -= key($converterTable);
    };

    return $r;
}

/* toWord recebe um inteiro $n e retorna o número escrito por extenso $str */
function toWord($n) {
    $ex = [
        ["zero", "um", "dois", "três", "quatro", "cinco", "seis", "sete", "oito", "nove", "dez", "onze", "doze", "treze", "quatorze", "quinze", "dezesseis", "dezessete", "dezoito", "dezenove"],
        ["dez", "vinte", "trinta", "quarenta", "cinquenta", "sessenta", "setenta", "oitenta", "noventa"],
        ["cem", "cento", "duzentos", "trezentos", "quatrocentos", "quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos"],
    ]; 
    $str = ""; // string retornada
    $dec = 0; // identifica em qual casa decimal um dígito está

    $r100 = $n%100;
    $mult = false; // flag : é múltiplo de 10?

    // se 0 < unidade+dezena < 20, o valor correspondente está em $ex[0]
    if ($r100 < 20 and $r100 > 0) {
        $str .= $ex[0][$r100];
        if ($n > 100) {
            $str = $ex[2][intdiv($n, 100)]." e ".$str;
        }
    }
    // senão percorre cada dígito
    else {
        while ($n > 0) {
            $d = $n%10;
            if ($d > 0) {
                switch($dec) {
                    case 0: $str .= $ex[$dec][$d];
                            break;
                    case 1: if (!$mult) $str = $ex[$dec][$d-1]." e ".$str;
                            else $str = $ex[$dec][$d-1].$str;
                            break;
                    case 2: if (!$mult) $str = $ex[$dec][$d]." e ".$str;
                            else if ($d === 1) $str = $ex[$dec][$d-1].$str;
                            else $str = $ex[$dec][$d]." e ".$str;
                            break;
                }
            }
            else $mult = true; // se d == 0, $n é múltiplo de 10
            $dec++;
            $n = intdiv($n, 10);
        }
    }
    return $str;
}

/* opToWord recebe um operador $op e retorna seu correspondente por extenso $str */
function opToWord($op) {
    switch($op) {
        case "+": $str = "mais";
                break;
        case "-": $str = "menos";
                break;
        case "*": $str = "vez";
                break;
        case "/": $str = "dividido por";
                break;
    }
    return $str;
}

?>