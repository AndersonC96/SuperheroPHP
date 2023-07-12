<?php
    function getRandomCharacter(){// Obter personagem aleatório
        $response = superheroAPIRequest("character/random");// Requisição
        if($response['response']['code'] == 200){// Sucesso
            $character = $response['body']['results'][0];// Personagem
            return $character;// Retornar personagem
        }else{// Erro
            $error = $response['body']['error'];// Erro
            return null;// Retornar nulo
        }
    }
?>
