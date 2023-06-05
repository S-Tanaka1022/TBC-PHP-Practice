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
$type = $typekey["name"];

#図鑑説明の取得
$exprain = $nameData['flavor_text_entries']['22']['flavor_text'];

#高さ・重さの取得
$height = $data['height'];
$weight = $data['weight'];

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
    <div style="margin-top: 20px;">
        <h1>$Jname</h1>
        <p><strong>タイプ: </strong>$type</p>
        <p><strong>図鑑説明: </strong>$exprain</p>
        <p><strong>高さ: </strong>$height </p>
        <p><strong>重さ: </strong>$weight </p>
    </div>
</body>

</html>

<form action="PokeAPI.php">
<input type='submit' value='一覧に戻る'>
</form>

___ex___;
