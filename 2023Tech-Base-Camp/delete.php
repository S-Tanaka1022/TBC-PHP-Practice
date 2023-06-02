<?php

$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'root';
$pass = 'root';

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null) {
        echo "接続に失敗しました。";
    } else {

        # SQL文を定める
        $SQL = <<<_SQL_
        DROP TABLE gacha
_SQL_;
        $dbh->query($SQL);
        echo "ガチャテーブルを削除しました。";
    }
} catch (PDOException $e) {
    echo "エラー内容：" . $e->getMessage();
    die();
}
$dbh = null;
