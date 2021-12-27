<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>CPS 530 Lab 5 Problem 1 by Dante Romita (Result)</title>
<style>
    table {
        font-size: 18pt;
        font-family: 'Courier New', Courier, monospace, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid gray;
        text-align: center;
        padding: 8px;
    }
</style>
</head>

<body>
    <header>
        <h1>CPS 530 Lab 5 Problem 1: Multiplication Table</h1>
        <p>Author: Dante Romita
        <br>Contact: <a href="mailto:dante.romita@ryerson.ca">dante.romita@ryerson.ca</a></p>
        <hr>
    </header>

    <h2>Create A Multiplication Table:</h2>

    <form action="https://www.cs.ryerson.ca/~dromita/cps530/labs/Lab_5/cps530_Lab5_P1-result.php" method="post">
        Enter number of rows (3-12): <input type="text" name="numRows"><br>
        Enter number of columns (3-12): <input type="text" name="numCols"><br>
        <br>
        <input style="font-size: 18pt;" type="submit">
    </form>
    
    <br><hr>

    <?php
    
    $numRows = (int) $_POST['numRows'];
    $numCols = (int) $_POST['numCols'];

    if (($numRows < 3) or ($numRows > 12) or ($numCols < 3) or ($numCols > 12)) {   //Checks for valid user input.
        echo ("
            <h3 style='color: red;'>Invalid Input</h3>
            <p style='color: red;'>
            Ensure that both fields contain <b>only numbers between 3 and 12 inclusive</b>.</p>
        ");
            } else {
                $mTable = []; //Create a 2D array with corresponding number of rows and columns entered by user
                
                for ($i = 0; $i < $numRows; $i += 1) {
                    $mTable[$i] = [];
                }   //Add corresponding number of empty rows to the table
                
                for ($j = 0; $j < $numCols; $j += 1) {
                    $mTable[0][$j] = ($j + 1);
                }   //Fill first row with numbers 1 to $numCols (Ex. If $numCols = 3, first row is [1,2,3])
                
                for ($i = 1; $i < $numRows; $i += 1) {
                    for ($j = 0; $j < $numCols; $j += 1) {
                        $mTable[$i][$j] = ($mTable[0][$j] * ($i + 1));
                    }
                }
                
                echo ("<h2>Result:</h2><table>");
                
                $row1_col1_Style = "<th style=\"background-color: palevioletred; color: rgb(60, 0, 0);\">";
                $rest_style = "<th style=\"background-color: palegreen; color: darkgreen;\">";
                
                for ($i = 0; $i < $numRows; $i += 1) {
                    for ($j = 0; $j < $numCols; $j += 1) {
                        if (($j == 0) or ($i == 0)) {
                            echo $row1_col1_Style;
                        } else {
                            echo $rest_style;
                        }
                        echo $mTable[$i][$j];
                        echo "</th>";
                    }
                    echo "</tr>";
                }
                echo ("</table>");
            }
            
            if (!isset($_COOKIE['numVisits'])) {
                $visitsCookie = 1;
                setcookie('numVisits', $visitsCookie);
                echo ("<p style=\"font-size: 16pt;\"><b >Number of visits:</b>"." 1</p>");
            } else {
                $visitsCookie = ++$_COOKIE['numVisits'];
                setCookie('numVisits', $visitsCookie);
                echo ("<p style=\"font-size: 16pt;\"><b >Number of visits:</b>"." ".$_COOKIE['numVisits']."</p>");
            }
    ?>

    <footer>
        <hr>
    
        <p>Author: Dante Romita
        <br>Contact: <a href="mailto:dante.romita@ryerson.ca">dante.romita@ryerson.ca</a></p>
    
    </footer>

</body>
</html>