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
    $detData = json_decode($detResponse, true);
    foreach ($detData['results'] as $key => $detValue)
        var_dump($detValue['forms']);
    var_dump($detValue['name']);
    var_dump($detValue['types']);
    var_dump($detValue['height']);
    var_dump($detValue['weight']);
    echo $detUrl . "<br>";
}
print("</pre>");
