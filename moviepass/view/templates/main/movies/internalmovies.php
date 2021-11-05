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
            $moviestableformwithfilter->title = "Movies from Database";

            $moviestableformwithfilter->filterFormAction = FRONT_ROOT . "Api/List/";
            $moviestableformwithfilter->genres = $genres;
            $moviestableformwithfilter->currPage = $currPage;
            $moviestableformwithfilter->genreW = $genreW;
            $moviestableformwithfilter->genreWO = $genreWO;
            $moviestableformwithfilter->maxPage = $maxPage;
            $moviestableformwithfilter->year = $year;
            $moviestableformwithfilter->name = $name;

            $moviestableformwithfilter->tableFormAction = FRONT_ROOT . "Movies/Delete";
            $moviestableformwithfilter->movies = $movies;
            $moviestableformwithfilter->params = array();
            $moviestableformwithfilter->headers = array('<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Delete</button>');
            $moviestableformwithfilter->inputs = array(
                function (int $movieid, array $params = []) {
                    return '<td><div class="col-auto">
                                    <input type="checkbox" class="form-check-input" id="mov' . $movieid . '" name="mov[]" value="' . $movieid . '">
                                    <label class="form-check-label" for="mov' . $movieid . '">Delete</label><br>
                            </div></td>';
                    "<?php echo FRONT_ROOT ?>Movies/GetMovieStatisics";
                }
            );

            echo $moviestableformwithfilter->render();
            ?>

            <br>
            <br>

            <?php
            $footer = new View("footer");
            $footer->content = "Designed by GroupThree";

            echo $footer->render();
            ?>
        </div>
    </main>
</body>