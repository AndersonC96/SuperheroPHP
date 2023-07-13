<!DOCTYPE html>
<html>
<head>
    <title>Superhero API - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Superhero API</a>
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
        <h1>Bem-vindo à Superhero API!</h1>
        <p>Seu site para explorar heróis e personagens de quadrinhos!</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
