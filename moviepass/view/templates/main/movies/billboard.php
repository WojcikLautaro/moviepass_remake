<?php

use Views\View;

$header = new View("header");
echo $header->render();
?>

<body class="d-flex flex-column h-100">
    <main role="main" class="container">
        <div class="mt-5">
            <?php
            $navbar = new View("navbar");
            $navbar->currUser = $currUser;

            echo $navbar->render();

            $moviestableformwithfilter = new View("moviestableformwithfilter");
            $moviestableformwithfilter->movies = $movies;
            $moviestableformwithfilter->genres = $genres;
            $moviestableformwithfilter->currPage = $currPage;
            $moviestableformwithfilter->maxPage = $maxPage;
            $moviestableformwithfilter->name = $name;
            $moviestableformwithfilter->genreW = $genreW;
            $moviestableformwithfilter->genreWO = $genreWO;
            $moviestableformwithfilter->year = $year;
            $moviestableformwithfilter->movHasFreeSeats = $movHasFreeSeats;
            $moviestableformwithfilter->formaction = FRONT_ROOT . "Billboard/List/";

            echo $moviestableformwithfilter->render();
        


            $footer = new View("footer");
            $footer->content = "Designed by GroupThree";
            
            echo $footer->render();
            ?>
        </div>
    </main>
</body>