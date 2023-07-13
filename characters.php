<?php
    function callAPI($url){// Função para chamar a API
        $apiKey = '1552656308273724';// Chave de acesso
        $curl = curl_init();// Inicializa a sessão cURL
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: 1552656308273724',
            ],
        ]);
        $response = curl_exec($curl);// Executa a sessão cURL
        curl_close($curl);// Fecha a sessão cURL
        return json_decode($response, true);// Retorna o resultado da sessão cURL
    }
    $page = isset($_GET['page']) ? $_GET['page'] : 1;// Página atual
    $perPage = 20;// Quantidade de itens por página
    $start = ($page - 1) * $perPage;// Índice do primeiro item da página
    $charactersURL = "https://superheroapi.com/api/1552656308273724/character?page=$page&pageSize=$perPage";// URL da API
    $charactersData = callAPI($charactersURL);// Chama a função callAPI() e armazena o resultado na variável $charactersData
    $totalPages = ceil($charactersData['total'] / $perPage);// Total de páginas
    echo '<h1>Personagens</h1>';// Título da página
    foreach($charactersData['results'] as $character){// Loop para exibir os personagens
        echo '<h2>' . $character['name'] . '</h2>';// Nome do personagem
        echo '<img src="' . $character['image']['url'] . '" alt="' . $character['name'] . '">';// Imagem do personagem
        echo '<hr>';// Linha horizontal
    }// Fim do loop
    if($page > 1){// Se a página atual for maior que 1, exibe o link para a página anterior
        echo '<a href="?page=' . ($page - 1) . '">Página anterior</a>';// Link para a página anterior
    }
    if($page < $totalPages){// Se a página atual for menor que o total de páginas, exibe o link para a próxima página
        echo '<a href="?page=' . ($page + 1) . '">Próxima página</a>';// Link para a próxima página
    }
?>
