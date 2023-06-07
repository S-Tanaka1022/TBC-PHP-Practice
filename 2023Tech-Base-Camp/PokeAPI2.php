<?php
$id = $_GET['dId'];
$url = "https://pokeapi.co/api/v2/pokemon/$id";
$response = file_get_contents($url);

// レスポンスデータは JSON 形式なので 、デコードして連想配列にする
$data = json_decode($response, true);

#日本語名の取得
$nameUrl = "https://pokeapi.co/api/v2/pokemon-species/$id";
$nameResponse = file_get_contents($nameUrl);
$nameData = json_decode($nameResponse, true);
$Jname = $nameData['names']['0']['name'];

#画像の取得
$img = ($data['sprites']['front_default']);
$img_back = ($data['sprites']['back_default']);

#英名の取得
$Ename = $data['name'];
#タイプの取得 
$typestring = $data['types'];
$typenum = $typestring[0];
$typekey = $typenum['type'];
$Etype = $typekey["name"];
$tyUrl = "https://pokeapi.co/api/v2/type/$Etype";
$TYResponse = file_get_contents($tyUrl);
$TYData = json_decode($TYResponse, true);
$type = $TYData["names"]["0"]["name"];

#図鑑説明の取得
$exprain = $nameData['flavor_text_entries']['22']['flavor_text'];

#高さ・重さの取得
$height = $data['height'] * 0.1;
$weight = $data['weight'] * 0.1;

echo <<<___ex___

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>{pokemon_name} - Pokemon Pokedex</title>
    <style>
        img {
            width: 300px;
            height: auto;
        }
    </style>
</head>

<body>
    <div style="display: flex; justify-content: center;">
        <img src=$img alt="Front">
        <img src=$img_back alt="Back">
    </div>
    <div style="margin: 20px 50px">
        <h1>$Jname</h1>
        <p><strong>タイプ: </strong>$type</p>
        <p><strong>図鑑説明: </strong>$exprain</p>
        <p><strong>高さ: </strong>{$height}m </p>
        <p><strong>重さ: </strong>{$weight}kg </p>
    
        <div style="display: flex;">
            <form action="PokeAPI.php">
            <input type='submit' value='一覧に戻る'>
            <input type='hidden' name='id' value='$id'>
            </form>
        </div>
    </body>

</html>



___ex___;
