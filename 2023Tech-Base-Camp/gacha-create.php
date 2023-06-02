<?php

#データベースに接続
$dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
$user = 'root';
$pass = 'root';

try {
    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null) {
        # エラーが起きたとき、ここは実行されずにcatch内が実行
    } else {

        $SQL = <<<_SQL_
    CREATE TABLE gacha (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    rarity VARCHAR(255),
    created_at timestamp default now()
    );
    ALTER TABLE gacha COLLATE 'utf8_general_ci';
_SQL_;

        $dbh->query($SQL);
        echo "ガチャテーブルを作成しました。";
    }
} catch (PDOException $e) {
    echo "エラー内容：" . $e->getMessage();
    die();
}
$dbh = null;
