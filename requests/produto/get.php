<?php

if(isset($key) && is_numeric($key)){
    $url = 'http://localhost:8080/produto/?id_produto=' . $key;
} else {
    $url = 'http://localhost:8080/produto/';
}

// INICIAR SESSÃO GLOBAL
$curl = curl_init();
// CONFIGURAR O CURL
curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Authorization: 209d5fae8b2ba427d30650dd0250942af944a0c9'
    ),
));
// RECUPERA O RETORNO DO CURL
$response = curl_exec($curl);
// ENCERRAR O CURL
curl_close($curl);

if(empty($response)) {
    $response = array();
} else {
    $response = json_decode($response, true);
}