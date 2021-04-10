<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Redressed&display=swap" rel="stylesheet">
</head>

<body onload="prepareBoard()">

    <?php
    require('class/GameManager.class.php');

    session_start();

    if(isset($_SESSION['gm'])) {
        $gm = $_SESSION['gm'];
    } else {
        $gm = new GameManager();
        $_SESSION['gm'] = $gm;
    }  
    ?>
    <form action="#" id="moveForm" method="POST">
        <input type="hidden" name="source" id="source">
        <input type="hidden" name="target" id="target">
        <!--<input type="submit" value="Przesuń figurę"><br>-->
    </form>
<main>
    <?php

    if (isset($_REQUEST['source']) && isset($_REQUEST['target'])) {
        $source = $_REQUEST['source'];
        $target = $_REQUEST['target'];
        echo "<h3>Próbuje przesunąć pionek z pola $source na pole $target</h3>";
        $gm->movePiece($source, $target);
    }
        echo $gm->getBoardHTML();
    ?>
     <div class="panel">
        <header>
            <h1>Szachy z bomby</h1>
            <p>Czas: 3 min</p>
</header>
<div class="przeciwnik-wrapper">
<div class="przeciwnik1">
<p>Przeciwnik 1</p>
<p>19:50</p>
</div>
<div class="przeciwnik2">
<p>Przeciwnik 2</p>
<p>13:37</p>
</div>
</div>
<div class="btn-wrapper">
<button><b>remis</b></button>
<button><b>poddaje się</b></button>
</div>
        <div class="chat-wrapper">
</div>
<div class="chat-input-wrapper">
Witam wszystkich tu serdecznie wchodzi majkel robi sie niebezpiecznie
</div>
    </main>
    
    <script>
        function prepareBoard() {
            let container = document.getElementById('grid-container');
            container.childNodes.forEach(function(element) {
                element.addEventListener("click", fieldClick);
            });

        }

        function fieldClick(e) {
            let source = document.getElementById('source');
            let target = document.getElementById('target');

            if (source.value) { //jeżeli podano źródło
                target.value = e.currentTarget.id;
                document.getElementById('moveForm').submit();
            } else { //jeżeli jeszcze nie ma źródła
                source.value = e.currentTarget.id;
            }
        }
    </script>

</body>

</html>