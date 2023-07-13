<?php
    function callAPI($url){// Função para chamar a API
        $apiKey = '1552656308273724';// Chave da API
        $curl = curl_init();// Inicializar o cURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: 1552656308273724',
            ],
        ]);
        $response = curl_exec($curl);// Executar a solicitação
        curl_close($curl);// Fechar o cURL
        return json_decode($response, true);// Retornar a resposta decodificada como um array associativo
    }
    $randomCharacterURL = "https://superheroapi.com/api/1552656308273724/random";// URL para um personagem aleatório
    $randomCharacterData = callAPI($randomCharacterURL);// Chamar a API e obter os dados do personagem aleatório
    $currentTime = time();// Obter o horário atual
    $lastRandomTime = isset($_COOKIE['lastRandomTime']) ? $_COOKIE['lastRandomTime'] : 0;// Obter o último horário aleatório
    if($currentTime - $lastRandomTime >= 24 * 60 * 60){// Se o último horário aleatório foi há mais de 24 horas
        echo '<h1>Personagem Aleatório</h1>';// Exibir o título
        echo '<h2>' . $randomCharacterData['name'] . '</h2>';// Exibir o nome do personagem aleatório
        echo '<img src="' . $randomCharacterData['image']['url'] . '" alt="' . $randomCharacterData['name'] . '">';// Exibir a imagem do personagem aleatório
        setcookie('lastRandomTime', $currentTime, time() + 24 * 60 * 60);// Definir o último horário aleatório como o horário atual
    }
?>