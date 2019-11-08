<div class="titulo">Converter</div>

<form action="#" method="post">
    <input type="text" name="a" id="a" value="<?= $_POST['a'] ?>"/>
    <input type="text" name="b" id="b" value="<?= $_POST['b'] ?>"/>
    <input type="text" name="op" id="op" value="<?= $_POST['op'] ?>"/>
    <button type="submmit">Send</button>
</form>

<?php

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

$a = $_POST['a'];
$b = $_POST['b'];
$op = $_POST['op'];

$p = romanToArabic($a, $converterTable);
print_r($p);
print_r("\n");
$q = romanToArabic($b, $converterTable);
print_r($q);
print_r("\n");

switch ($op) {
    case "+":
        print_r(arabicToRoman($p+$q, $converterTable)."\n");
        print_r($p+$q);
        break;
    case "-":
        print_r(arabicToRoman($p-$q, $converterTable)."\n");
        print_r($p-$q);
        break;
    case "*":
        print_r(arabicToRoman($p*$q, $converterTable)."\n");
        print_r($p*$q);
        break;
    case "/":
        print_r(arabicToRoman($p/$q, $converterTable)."\n");
        print_r($p/$q);
        break;
    default:
        print_r("invalid operation");
}

function romanToArabic($string, $array) {
    $chars = str_split($string);
    $n = 0;
    reset($chars);
    while(key($chars) !== null) {
        $cur = $chars[key($chars)];
        next($chars);
        $arabic = array_search($cur.$chars[key($chars)], $array);
        if ($arabic) {
            $n += $arabic;
        }
        else {
            prev($chars);
            $arabic = array_search($chars[key($chars)], $array);
            $n += $arabic;
        }
        next($chars);
    }

    return $n;
}

function arabicToRoman($x, $array) {
    $r = '';

    while ($x > 0) {
        // find the highest decimal value
        reset($array);
        while(key($array) !== null && $x >= key($array)) {
            next($array);
        };
        $v = prev($array);
        $r .= $v;
        $x -= key($array);
    };

    return $r;
}

?>

<script>
    var extenso = require('extenso');

</script>
