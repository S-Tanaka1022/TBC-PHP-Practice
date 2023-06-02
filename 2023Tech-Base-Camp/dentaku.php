<form action="dentaku.php" method="get">
    <input type="text" name="num1">
    <input type="text" name="num2">
    <input type="radio" name="enzan" value="wa">和
    <input type="radio" name="enzan" value="sa">差
    <input type="radio" name="enzan" value="se">積
    <input type="radio" name="enzan" value="syo">商
    <input type="submit" value="計算">
</form>

<?php
if ($_GET) {
    if (is_numeric($_GET["num1"]) && is_numeric($_GET["num2"])) {
        $num1 = $_GET["num1"];
        $num2 = $_GET["num2"];

        if (isset($_GET["enzan"])) {
            if ($_GET["enzan"] == "wa") {
                echo $num1 + $num2;
            } elseif ($_GET["enzan"] == "sa") {
                echo $num1 - $num2;
            } elseif ($_GET["enzan"] == "se") {
                echo $num1 * $num2;
            } elseif ($_GET["enzan"] == "syo") {
                echo $num1 / $num2;
            }
        } else {
            echo "<h1>四則演算を選択してください</h1>";
        }
    } else {
        echo "<h1>数字を入力してください</h1>";
    }
}
