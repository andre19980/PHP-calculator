<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Calculadora</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="scripts.js"></script>
    </head>
    <body> 
        <? require("./calculator.php") ?>
        <div class="wrapper">
            <form action="#" method="post">
                <!-- input area -->
                <div class="head">
                    <input type="text"
                        class="number" 
                        name="a" 
                        id="a" 
                        value=""
                        onclick="setInput(true)"
                        oninput="updateValue()"/>
                    <select class="operator" name="op" id="op">
                        <option>+</option>
                        <option>-</option>
                        <option>*</option>
                        <option>/</option>
                    </select>
                    <input type="text" 
                        class="number" 
                        name="b"
                        id="b"
                        value=""
                        onclick="setInput(false)"
                        oninput="updateValue()"/>
                </div>
                
                <!-- keyboard area -->
                <div class="buttons">
                    <button type="button" value="I" onclick="updateInput('I')">I</button>
                    <button type="button" value="V" onclick="updateInput('V')">V</button>
                    <button type="button" value="X" onclick="updateInput('X')">X</button>
                    <button type="button" value="L" onclick="updateInput('L')">L</button>
                    <button type="button" value="C" onclick="updateInput('C')">C</button>
                    <button type="button" value="D" onclick="updateInput('D')">D</button>
                    <button type="button" value="M" onclick="updateInput('M')">M</button>
                    <button 
                        type="submit" 
                        id="evaluate" 
                        value="="
                        equal
                    >
                        =
                    </button>
                </div>
            </form>
            <?php
                if ($_POST['a'] and $_POST['b']) {
                    $error; // mensagem de erro

                    /* requisição dos dados */
                    try {
                        $a = checkValue($_POST['a']);
                        $b = checkValue($_POST['b']);
                    } catch (Exception $e) {
                        $error = $e->getMessage()."\n";
                    }
                    $op = $_POST['op'];
                    try {
                        $res = checkValue(evaluate($a, $b, $op));
                    } catch (Exception $e){
                        $error = $e->getMessage()."\n";
                    }

                    $operation = arabicToRoman($a)." ".$op." ".arabicToRoman($b)." = ".arabicToRoman($res)." ( ".$res." ) ";
                }
            ?>
            
            <!-- result area -->
            <div class="result">
                <div class="text">
                    <div id="board">
                        <?php 
                            if (!$error) echo $operation;
                            else echo $error;
                        ?>
                    </div>
                    <div id="ext" style="display:none;">
                        <? echo toWord($a)." ".opToWord($op)." ".toWord($b)." é igual a ".toWord($res) ?>
                    </div>
                </div>
                <div class="icon" onclick="extenso()"><img src="./assets/cubes.svg" width="20px" height="20px"></div>
            </div>
        </div>
    </body>
</html>

