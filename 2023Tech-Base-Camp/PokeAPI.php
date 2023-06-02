<?php
// PokeAP1 のデータを取得する ( id = 11 から 29 のポケモンのデータ ) * /
$url = 'https://pokeapi.co/api/v2/pokemon/?limit=10$offset=0';
$response = file_get_contents($url);

// レスポンスデータは JSON 形式なので 、デコードして連想配列にする
$data = json_decode($response, true);

// 取得結果をループさせてポケモンの名前を表示する
print("<pre>");
foreach ($data['results'] as $key => $value) {
    var_dump($value['name']);
}
print("</pre>");
