<?php
    error_reporting(0);// Desabilita a exibição de erros
    ini_set('display_errors', 0);// Desabilita a exibição de erros
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="https://cdn.icon-icons.com/icons2/1371/PNG/512/batman_90804.png">
        <title>Superhero API - Pesquisar Personagens</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#"><img src="./media/logo.png" class="img-fluid max-width-logo" alt="Superhero API Logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="characters.php">Personagens</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="random_character.php">Personagem Aleatório</a>
                    </li>
                </ul>
            </div>
            <form class="d-flex" action="search.php" method="GET">
                <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar" name="search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
        </nav>
        <div class="container">
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
                    if(isset($searchData['results']) && !empty($searchData['results'])){
                        echo '<div class="row">';
                        foreach($searchData['results'] as $result){// Para cada resultado
                            echo '<div class="col-md-4 mb-3">';
                            echo '<div class="card">';
                            echo '<img src="' . $result['image']['url'] . '" alt="' . $result['name'] . '" class="card-img-top">';
                            echo '<div class="card-body">';
                            echo '<h5 class="card-title"><b>' . $result['name'] . '</b></h5>';// Exibir o nome do personagem
                            echo '<hr>';
                            echo '<ul class="list-group list-group-flush">';
                            echo '<li class="list-group-item"><h5 class="card-title"><b>Stats</b></h5></li>'; // Exibir o título das estatísticas
                            $stats = [
                                'Inteligência' => $result['powerstats']['intelligence'],
                                'Força' => $result['powerstats']['strength'],
                                'Velocidade' => $result['powerstats']['speed'],
                                'Durabilidade' => $result['powerstats']['durability'],
                                'Poder' => $result['powerstats']['power'],
                                'Combate' => $result['powerstats']['combat']
                            ];// Array com as estatísticas
                            foreach($stats as $statName => $statValue){
                                echo '<h5 class="card-title"><b>' . $statName . ': </b></h5>';
                                echo '<div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">';
                                echo '<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ' . $statValue . '%" aria-valuenow="' . $statValue . '" aria-valuemin="0" aria-valuemax="100">'.$statValue.'%'.'</div>';
                                echo '</div>';
                            }// Para cada estatística
                            echo '<hr>';
                            echo '<ul class="list-group list-group-flush">';
                            echo '<li  class="list-group-item"><h5 class="card-title"><b>Biografia</b></h5></li>';// Exibir o título da biografia
                            echo '<h5 class="card-title">';
                            echo '<h5 class="card-title"><b>Nome: </b>' . $result['biography']['full-name'] . '</h5>';// Exibir o nome completo do personagem
                            echo '<h5 class="card-title"><b>Alter ego: </b>' . $result['biography']['alter-egos'] . '</h5>';// Exibir o alter ego do personagem
                            echo '<h5 class="card-title"><b>Apelidos: </b>' . $result['biography']['aliases']['1'] . '</h5>';// Exibir o primeiro apelido do personagem
                            echo '<h5 class="card-title"><b>Local de nascimento: </b>' . $result['biography']['place-of-birth'] . '</h5>';// Exibir o local de nascimento do personagem
                            echo '<h5 class="card-title"><b>Primeira aparição: </b>' . $result['biography']['first-appearance'] . '</h5>';// Exibir a primeira aparição do personagem
                            echo '<h5 class="card-title"><b>Publicadora: </b>' . $result['biography']['publisher'] . '</h5>';// Exibir a publicadora do personagem
                            echo '<h5 class="card-title"><b>Moral: </b>' . $result['biography']['alignment'] . '</h5>';// Exibir a moral do personagem
                            echo '<hr>';
                            echo '<li class="list-group-item"><h5 class="card-title"><b>Aparência</b></h5></li>';// Exibir o título da aparência
                            echo '<h5 class="card-title">';// Exibir o título da aparência
                            echo '<h5 class="card-title"><b>Gênero : </b>' . $result['appearance']['gender'] . '</h5>';// Exibir o gênero do personagem
                            echo '<h5 class="card-title"><b>Raça: </b>' . $result['appearance']['race'] . '</h5>';// Exibir a raça do personagem
                            echo '<h5 class="card-title"><b>Altura: </b>' . $result['appearance']['height']['1'] . '</h5>';// Exibir a altura do personagem
                            echo '<h5 class="card-title"><b>Peso: </b>' . $result['appearance']['weight']['1'] . '</h5>';// Exibir o peso do personagem
                            echo '<h5 class="card-title"><b>Cor dos olhos: </b>' . $result['appearance']['eye-color'] . '</h5>';// Exibir a cor dos olhos do personagem
                            echo '<h5 class="card-title"><b>Cor dos cabelos: </b>' . $result['appearance']['hair-color'] . '</h5>';// Exibir a cor dos cabelos do personagem
                            echo '<hr>';
                            echo '<li class="list-group-item"><h5 class="card-title"><b>Trabalho</b></h5></li>';// Exibir o título do trabalho
                            echo '<h5 class="card-title">';// Exibir o título do trabalho
                            echo '<h5 class="card-title"><b>Ocupação: </b>' . $result['work']['occupation'] . '</h5>';// Exibir a ocupação do personagem
                            echo '<h5 class="card-title"><b>Local: </b>' . $result['work']['base'] . '</h5>';// Exibir o local do personagem
                            echo '<hr>';
                            echo '<li class="list-group-item"><h5 class="card-title"><b>Conexões</b></h5></li>';// Exibir o título das conexões
                            echo '<h5 class="card-title">';// Exibir o título das conexões
                            echo '<h5 class="card-title"><b>Grupos afiliados: </b>' . $result['connections']['group-affiliation'] . '</h5>';// Exibir os grupos afiliados do personagem
                            echo '<h5 class="card-title"><b>Relações: </b>' . $result['connections']['relatives'] . '</h5>';// Exibir as relações do personagem
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        echo '</div>';
                    }else{
                        echo '<p>Nenhum resultado encontrado.</p>';
                    }
                }
            ?>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>