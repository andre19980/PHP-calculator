<div class="titulo">Converter</div>

<form action="#" method="post">
    <input type="text" name="x" id="x" value="<?= $_POST['x'] ?>"/>
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
    
    $x = (int)$_POST['x'];
    $r = '';
    echo $x."\n";

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

    echo $r."\n";
?>

