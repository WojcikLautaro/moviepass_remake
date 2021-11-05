<?php

use Views\View;
?>

<br>
<h1 class="mt-5"><?php echo $title; ?></h1>
<br>

<?php
$moviesfilter = new View("moviesfilter");
$moviesfilter->movies = $movies;
$moviesfilter->genres = $genres;
$moviesfilter->currPage = $currPage;
$moviesfilter->name = $name;
$moviesfilter->genreW = $genreW;
$moviesfilter->genreWO = $genreWO;
$moviesfilter->maxPage = $maxPage;
$moviesfilter->year = $year;
$moviesfilter->formaction = $filterFormAction;
$moviesfilter->method = "POST";

echo $moviesfilter->render();

$moviestable = new View("moviestableform");
$moviestable->movies = $movies;
$moviestable->action = $talbeFormAction;
$moviestable->method = "POST";
$moviestable->params = array();
$moviestable->headers = array('<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Delete</button>');
$moviestable->inputs = array(
    function (int $movieid, array $params = []) {
        return '<td><div class="col-auto">
                        <input type="checkbox" class="form-check-input" id="mov' . $movieid . '" name="mov[]" value="' . $movieid . '">
                        <label class="form-check-label" for="mov' . $movieid . '">Delete</label><br>
                </div></td>';
        "<?php echo FRONT_ROOT ?>Movies/GetMovieStatisics";
    }
);

echo $moviestable->render();
?>