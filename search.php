<?php
    function callAPI($url){
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
    if(isset($_GET['search'])){// Se o termo de pesquisa estiver definido
        $searchTerm = $_GET['search'];// Obter o termo de pesquisa
        $searchURL = "https://superheroapi.com/api/1552656308273724/search/$searchTerm";// URL para pesquisar um personagem
        $searchData = callAPI($searchURL);// Chamar a API e obter os dados da pesquisa
        echo '<h1>Resultado da pesquisa: ' . $searchTerm . '</h1>';// Exibir o título
        foreach($searchData['results'] as $result){// Para cada resultado
            echo '<h2>' . $result['name'] . '</h2>';// Exibir o nome do personagem
            echo '<img src="' . $result['image']['url'] . '" alt="' . $result['name'] . '">';// Exibir a imagem do personagem
            echo '<hr>';// Exibir uma linha horizontal
        }
    }
?>
<h1>Pesquisar Personagens</h1>
<form action="" method="GET">
    <input type="text" name="search" placeholder="Digite o nome do personagem">
    <button type="submit">Pesquisar</button>
</form>