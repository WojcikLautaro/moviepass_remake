<?php

use Model\Models\Genre;
use Model\Models\Movie;
use Views\View;

$movietable = new View("table");
$movietable->tableheaders = array_merge(
    array("Title", "Description", "Genres", "Photo"),
    (isset($headers)) ? $headers : array()
);

$tablerows = array();
foreach ($movies as $movie) {
    if ($movie instanceof Movie) {
        $moviegenres = "";

        foreach ($movie->genres() as $genre)
            if ($genre instanceof Genre)
                $moviegenres .= $genre->getDescription() . '<br>';

        $moviephoto = null;
        if ($movie->getPoster() != null) {
            $moviephoto = new View("image");
            $moviephoto->width = "100";
            $moviephoto->height = "147";
            $moviephoto->src = $movie->getPoster();
            $moviephoto = $moviephoto->render();
        }

        $moviearr = array(
            $movie->getTitle(),
            $movie->getDescription(),
            $moviegenres,
            ($moviephoto != null) ? $moviephoto : ""
        );

        foreach ($inputs as $input) {
            $inputtoconcat = call_user_func($input, $movie->getId(), $params);
            if ($inputtoconcat != null) {
                array_push($moviearr, $inputtoconcat);
            }
        }

        array_push($tablerows, $moviearr);
    }
}
$movietable->tablerows = $tablerows;

echo $movietable->render();
