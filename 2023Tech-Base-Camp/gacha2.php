<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ガチャシステム</title>
    <link rel="stylesheet" href="gacha2.css">
</head>

<body>
    <form action="gacha2.php">
        <!-- <input type="text" name="char" value=""> -->
        <input type="submit" name="gacha" value="ガチャを回す">
        <input type="submit" name="zero" value="データを全て削除する">
    </form>
</body>

<?php
#追加機能
if ($_GET && isset($_GET["gacha"])) {
    #連想配列を定義
    $char = array(
        21 => "ピカチュウ", 1 => "フシギダネ", 80 => "リザードン",
        11 => "ブラッキー", 2 => "ヒトカゲ", 3 => "ゼニガメ",
        81 => "ルカリオ", 5 => "イーブイ", 28 => "ゲッコウガ",
        82 => "ミュウ", 83 => "カイリュー", 84 => "レックウザ",
        16 => "グレイシア", 25 => "ラプラス", 18 => "ニンフィア",
        23 => "ゲンガー", 6 => "ポッポ", 7 => "ポッチャマ",
        8 => "ピチュー", 9 => "ロコン（アローラのすがた）", 10 => "エモンガ",
        11 => "リーフィア", 12 => "ブースター", 24 => "レントラー",
    );

    #レアリティ別の空配列を用意
    $char1 = array();
    $char4 = array();
    $char7 = array();
    $char80 = array();

    #連想配列からレアリティ別の配列へ全て分類
    foreach ($char as $rarid => $name) {

        if ($rarid <= 10) {
            array_push($char1, $name);
        } elseif (10 < $rarid && $rarid <= 20) {
            array_push($char4, $name);
        } elseif (20 < $rarid && $rarid <= 30) {
            array_push($char7, $name);
        } elseif (30 < $rarid) {
            array_push($char80, $name);
        } else {
            echo "レアリティ配列の作成に失敗しました。";
        }
    }
    #10体溜まったらレア度が上がるようにする？

    #レアリティごとにランダムにキャラを一つ取り出す
    $randname1 = $char1[array_rand($char1, 1)];
    $randname4 = $char4[array_rand($char4, 1)];
    $randname7 = $char7[array_rand($char7, 1)];
    $randname80 = $char80[array_rand($char80, 1)];

    #100%で確率を定義
    $rand = rand(1, 100);

    #星1は40%に設定
    if (1 <= $rand && $rand < 40) {
        $rarity = 1;
        $charname = $randname1;
    }
    #星4は30%に設定
    elseif (40 <= $rand && $rand < 70) {
        $rarity = 2;
        $charname = $randname4;
    }
    #星7は20%に設定
    elseif (70 <= $rand && $rand < 90) {
        $rarity = 3;
        $charname = $randname7;
    }
    #星80は10%に設定
    else {
        $rarity = 4;
        $charname = $randname80;
    }


    #データベースに接続
    $dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = 'root';
    $time = date("Y-m-d H:i:s");
    echo $time;
    #$randに合わせて設定された$rarityと$charnameを挿入
    if ($_GET) {
        try {
            $dbh = new PDO($dsn, $user, $pass);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($dbh == null) {
                echo "接続に失敗しました。";
            } else {

                # SQL文を定める
                $SQL = <<<_SQL_
        INSERT INTO gacha(
        name,
        rarity,
        created_at
        )
        VALUES (
        '{$charname}',
        '{$rarity}',
        '{$time}'
        )
_SQL_;

                # SQL文の実行
                $dbh->query($SQL);
                echo "gachaテーブルに" . $charname . "を追加しました。";
            }
        } catch (PDOException $e) {
            echo "エラー内容：" . $e->getMessage();
            die();
        }
        $dbh = null;
    }
}

#削除機能
if (isset($_GET["delete"])) {
    #データベースに接続
    $dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = 'root';

    try {
        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($dbh == null) {
            echo "接続に失敗しました。";
        } else {
            # 登録のSQL文を定義
            $delete = "DELETE from gacha WHERE id = {$_GET['delid']}";

            # SQL文の実行
            $dbh->query($delete);
            echo ("gachaテーブルのデータを削除しました。");
        }
    } catch (PDOException $e) {
        echo "エラー内容：" . $e->getMessage();
        die();
    }
    $dbh = null;
} elseif (isset($_GET["zero"])) {
    #データベースに接続
    $dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = 'root';

    try {
        $dbh = new PDO($dsn, $user, $pass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if ($dbh == null) {
            echo "接続に失敗しました。";
        } else {
            # 登録のSQL文を定義
            $delete = <<<_zero_
            DELETE from gacha;
            ALTER TABLE `gacha` auto_increment = 1;
        _zero_;
            # SQL文の実行
            $dbh->query($delete);
            echo ("gachaテーブルの全データを削除しました。");
        }
    } catch (PDOException $e) {
        echo "エラー内容：" . $e->getMessage();
        die();
    }
    $dbh = null;
    #トップページへリダイレクト

}





if (isset($_GET["header"])) {
    header("Location:gacha2.php");
}

#表示機能
try {
    $dsn = 'mysql:host=localhost; dbname=booksample; charset=utf8';
    $user = 'root';
    $pass = 'root';


    $dbh = new PDO($dsn, $user, $pass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($dbh == null) {
        echo "接続に失敗しました。";
    } else {

        #テーブルの1行目、項目を定義、表示
        $table = <<<_table_
        <hr>
        <h3>キャラクター一覧</h3>
        <table border=1>
            <tr>
                <th>ID</th>
                <th>キャラクター名</th>
                <th>レアリティ</th>
                <th>追加時刻</th>
                <th>削除</th>
            </tr>
        _table_;

        echo $table;

        #テーブルのSQL部分、idが含まれるリクエストがされた場合
        if (isset($_GET["id"])) {

            # そのidのみ取得のSQL文を定義、準備
            $seldb = "SELECT * from gacha WHERE id = {$_GET['id']}";
            $stmt = $dbh->prepare($seldb);

            # SQL文の実行
            $stmt->execute();

            #全データの取得は完了

            #$stmtに取得された情報がテーブル形式で代入されるため、それを1行ごとに$rowに代入し、それぞれのカラムに変数を命名
            while ($row = $stmt->fetch()) {
                $id = $row["id"];
                $name = $row["name"];
                $rarity = $row["rarity"];
                $time = $row["created_at"];

                #取得したデータを表示（item_nameには$idで単体表示するリンクをつける）
                $select = <<<_select_
                    <tr>
                        <td>{$id}</td>
                        <td><a href="gacha2.php?id={$id}">{$name}</a></td>
                        <td>{$rarity}</td>
                        <td>{$time}</td>
                        <td>
                            <form onSubmit='return check()'>
                                <input type='submit' name='delete' value='削除'>
                                <input type='hidden' name='id' value={$id}>
                            </form>
                        </td>

                    </tr>
                _select_;

                echo $select;
            }
            #テーブルのSQL部分、ただのリクエストがされた場合    
        } else {

            # 全データを取得するSQL文を定義、準備
            $seldb = "SELECT * from gacha";
            $stmt = $dbh->prepare($seldb);

            # SQL文の実行
            $stmt->execute();

            #全データの取得は完了

            #$stmtに取得された情報がテーブル形式で代入されるため、それを1行ごとに$rowに代入し、それぞれのカラムに変数を命名
            while ($row = $stmt->fetch()) {
                $id = $row["id"];
                $name = $row["name"];
                $rarity = $row["rarity"];
                $time = $row["created_at"];

                #取得したデータを表示（item_nameには$idで単体表示するリンクをつける）
                $select = <<<_select_
                    <tr>
                        <td>{$id}</td>
                        <td><a href="gacha2.php?id={$id}">{$name}</a></td>
                        <td>{$rarity}</td>
                        <td>{$time}</td>
                        <td>
                            <form onSubmit='return check()'>
                               <input type='submit' name='delete' value='削除'>                                
                               <input type='hidden' name='delid' value={$id}>
                            </form>
                        </td>
                    </tr>
                _select_;

                echo $select;
            }
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "エラー内容：" . $e->getMessage();
    die();
}
$dbh = null;


echo <<<_header_
    <form action="gacha2.php">
    <input type = "submit" name="header" value="トップページに戻る">
    </form>
    _header_;


echo <<<_script_
<script type="text/javascript"> 
<!-- 

function check(){

	if(window.confirm('削除してよろしいですか？')){ // 確認ダイアログを表示

		return true; // 「OK」時は送信を実行

	}
	else{ // 「キャンセル」時の処理

		window.alert('キャンセルされました'); // 警告ダイアログを表示
		return false; // 送信を中止

	}

}

// -->
</script>
_script_;
