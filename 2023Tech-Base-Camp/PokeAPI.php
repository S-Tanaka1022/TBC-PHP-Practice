<?php
// PokeAP1 のデータを取得する ( id = 11 から 29 のポケモンのデータ ) * /
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=10$offset=0';
$response = file_get_contents($url);

// レスポンスデータは JSON 形式なので 、デコードして連想配列にする
$data = json_decode($response, true);
// var_dump($data);
// 取得結果をループさせてポケモンの名前を表示する
print("<pre>");
foreach ($data['results'] as $key => $value) {
    $detUrl = ($value['url']);

    $detResponse = file_get_contents($detUrl);
    var_dump($value['forms']);
    var_dump($value['name']);
    var_dump($value['types']);
    var_dump($value['height']);
    var_dump($value['weight']);
    echo $detUrl . "<br>";
}
print("</pre>");
