<?php
    require_once 'config.php';// Configurações
    require_once 'functions.php';// Funções
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Digite o nome do personagem">
        <input type="submit" value="Pesquisar">
    </form>
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;// Página atual
    $start = ($page - 1) * RESULTS_PER_PAGE;// Início da página
    $end = $start + RESULTS_PER_PAGE;// Fim da página
    $response = superheroAPIRequest("characters", [
        'limit' => RESULTS_PER_PAGE,
        'offset' => $start
    ]);
    if($response['response']['code'] == 200){// Sucesso
        $characters = $response['body']['results'];// Personagens
        $totalCharacters = $response['body']['total'];// Total de personagens
    }else{// Erro
        $error = $response['body']['error'];// Erro
        echo "Erro na requisição: $error";// Exibir erro
    }
    foreach($characters as $character){// Para cada personagem
        $name = $character['name'];// Nome do personagem
        $image = $character['image']['url'];// Imagem do personagem
        echo "<h2>$name</h2>";// Exibir nome
        echo "<img src='$image' alt='$name'>";// Exibir imagem
    }
    $totalPages = ceil($totalCharacters / RESULTS_PER_PAGE);// Total de páginas
    for($i = 1; $i <= $totalPages; $i++){// Para cada página
        $isActive = ($i == $page) ? 'active' : '';// Página atual
        echo "<a href='index.php?page=$i' class='$isActive'>$i</a>";// Exibir página
    }
?>