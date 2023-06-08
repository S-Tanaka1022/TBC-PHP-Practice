<?php
if (isset($_GET["10"])) {
    $limit = 10;
} elseif (isset($_GET["20"])) {
    $limit = 20;
} elseif (isset($_GET["50"])) {
    $limit = 50;
} elseif (isset($_GET["100"])) {
    $limit = 100;
} elseif (isset($_GET["count"])) {
    $limit = $_GET["count"];
} else {
    $limit = 10;
}

if (isset($_GET["next"])) {
    $page = $_GET["page"] + $limit;
} elseif (isset($_GET["back"]) && $_GET["page"] >= 10) {
    $page = $_GET["page"] - $limit;
} elseif (isset($_GET["id"])) {
    $page = $_GET["id"] - 1;
} elseif (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 0;
}

#テーブル部分の作成
echo <<<___title___
    <img src='data:image/jpeg;base64,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'>
    <h3>CHARACTERS</h3>
        <table border=1>
            <tr>
                <th id="form">form</th>
                <th id="name">name</th>
                <th id="type">type</th>
                <th id="height">height(m)</th>
                <th id="weight">weight(kg)</th>
                <th>detail</th>
            </tr>
___title___;


function getCacheContents($url, $cachePath, $cacheLimit = 86400)
{
    if (file_exists($cachePath) && filemtime($cachePath) + $cacheLimit > time()) {
        // キャッシュ有効期間内なのでキャッシュの内容を返す
        return file_get_contents($cachePath);
    } else {
        // キャッシュがないか、期限切れなので取得しなおす
        $data = file_get_contents($url);
        file_put_contents($cachePath, $data, LOCK_EX); // キャッシュに保存
        return $data;
    }
}

$url = "https://pokeapi.co/api/v2/pokemon/?limit=$limit&offset=$page";

$cachePath = './cache/' . $page . '.json';
// PokeAP1 のデータを取得する ( id = 11 から 29 のポケモンのデータ ) * /

$pokemonData = getCacheContents($url, $cachePath, $cacheLimit = 86400);
// var_dump($pokemonData);

// レスポンスデータは JSON 形式なので 、デコードして連想配列にする
$data = json_decode($pokemonData, true);


#繰り返して1つ1つ結果を処理
// var_dump($data);
foreach ($data['results'] as $key => $value) {

    $detUrl = ($value['url']);
    $cachePath = './cache/' . $value['name'] . '.json';
    $pokemonData = getCacheContents($detUrl, $cachePath);
    $detData = json_decode($pokemonData, true);

    #日本語名の取得
    $id = $detData['id'];
    $img = ($detData['sprites']['front_default']);


    $nameUrl = "https://pokeapi.co/api/v2/pokemon-species/$id";
    $cachePath = './cache/nameid=' . $id . '.json';
    $pokemonData = getCacheContents($nameUrl, $cachePath);
    $nameData = json_decode($pokemonData, true);
    $Jname = $nameData['names']['0']['name'];

    #英名の取得
    $Ename = $detData['name'];

    echo <<<___table___
        <tr>
            <th class="im"><img src='{$img}'></th>
            <th class="na">{$Jname}</th><th class="ty">
    ___table___;



    #高さ・重さの取得
    $height = $detData['height'] * 0.1;
    $Height = $detData['height'] * 2;
    $weight = $detData['weight'] * 0.1;
    $Weight = $detData['weight'] * 0.05;

    #タイプの取得 
    $typestring = $detData['types'];
    foreach ($typestring as $key => $value) {
        $Etype = ($value["type"]["name"]);

        $tyUrl = "https://pokeapi.co/api/v2/type/$Etype";
        $cachePath = './cache/' . $Etype . '.json';
        $pokemonData = getCacheContents($tyUrl, $cachePath);
        $TYData = json_decode($pokemonData, true);
        $type = $TYData["names"]["0"]["name"];
        echo "{$type}<br>";
    }

    echo <<<___table___
            </th><th style="font-size: {$Height}px;">{$height}</th>
            <th style="font-size: {$Weight}px;">{$weight}</th>
            <th class="de">
                <form action='PokeAPI2.php'>
                    <input type='submit' name='detail' value='check'>
                    <input type='hidden' name='dId' value={$id}>
                </form>
            </th>
        </tr>
    <style>
        @import url('https://fonts.googleapis.com/css?family=M+PLUS+Rounded+1c');
        html{
            font-family: 'M PLUS Rounded 1c', sans-serif;
        }

        /* テーブルの外縁を調整する */
        table {
            border: 3px solid #000000; /* 外縁の太さと色を指定 */
            text-align: ceneter;
            width: 100%;
        }

        .na, .im, .ty, .de{
            font-size: 20px;
        }

        img {
            height: 120px;
        }
        #form{
            width: 35%;
        }
        /* 各セルの幅を調整する */
        #name, #type, #height, #weight {
            width: 15%; /* 幅を指定 */
        }

        /* 幅を自動調整するセルの指定（ここでは「detail」列） */
        th:not(#form):not(#name):not(#type):not(#height):not(#weight) {
            width: 5%;
        }
    </style>
___table___;
}
echo "</table>";

echo <<<___form___
    <form action="PokeAPI.php">
        <input type="submit" name="back" value="back">
        <input type="submit" name="next" value="next">
        <input type="hidden" name="page" value="{$page}">
        <hr>
    <p>表示数変更(現在:{$limit}匹)</p>
        <input type="submit" name="10" value="10匹">
        <input type="submit" name="20" value="20匹">
        <input type="submit" name="50" value="50匹">
        <input type="submit" name="100" value="100匹">
        <input type="hidden" name="count" value="{$limit}">
    </form><hr>
___form___;
