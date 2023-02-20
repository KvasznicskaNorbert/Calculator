<?php
session_start();

    spl_autoload_register(function ($type){
        include "classes/" . $type .".php";
    });
    $obj = new Calculator();

    if(isset($_POST["ok"])){
        if(isset($_POST["value1"], $_POST["value2"])){
            $symbol = "";
            switch ($_POST["operation"]){
                case "add":
                    $symbol ="+";
                    break;
                case "subtraction":
                    $symbol ="-";
                    break;
                case "multiplication":
                    $symbol = "*";
                    break;
                case "division":
                    $symbol = "/";
                    break;       
            }

            $function = $_POST["operation"];
            $result = $obj->$function ($_POST["value1"], $_POST["value2"]);
            $_SESSION["result"] = $result;
            //$obj->UpdateHistory("<p>$_POST[value1] $symbol $_POST[value2] = $result</p>");
            $historyItem = "<p>$_POST[value1] $symbol $_POST[value2] = $result</p>";
            $_SESSION["history"][] = $historyItem;
        }
    }

    if(isset($_POST["deleteHistory"])){
        if(isset($_SESSION["history"])){

            foreach ($_SESSION["history"] as $i => $value) {
                unset($_SESSION["history"][$i]);
                
            }

            session_destroy(); 
        }
        if(isset($_SESSION["result"])){
            unset($_SESSION["result"]);
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
</head>
<body>

    <form method="post">
        <input type="number" name="value1" id="value1" value="<?php if(isset($_SESSION["result"])){print($_SESSION["result"]);} ?>">
        <select name="operation" id="operation">
            <option value="add">Add</option>
            <option value="subtraction">Subtraction</option>
            <option value="multiplication">Multiplication</option>
            <option value="division">Division</option>
        </select>
        <input type="number" name="value2" id="value2">
        <input type="submit" name="ok" value="Calculate">
    </form>
    <form method="post">
    <input type="submit" name="deleteHistory" value="Delete History">
    </form>

    <?php

    if(isset($result)){
        foreach($_SESSION["history"] as $history){
            print($history);
        }
        
    }

   
    
    ?>
    
</body>
</html>