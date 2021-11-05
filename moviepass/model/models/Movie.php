<?php

namespace Model\Models;

use Model\Models\ClosureModel;

class Movie extends ClosureModel
{
    public static function fromApi(array $obj)
    {
        if (!isset($obj["release_date"]))
            $obj["release_date"] = '0000-00-00';

        if (!isset($obj["runtime"]))
            $obj["runtime"] = '00:00:00';

        else if ($obj["runtime"] == "0")
            $obj["runtime"] = '00:00:00';

        $movie = new Movie();
        $movie->title = (string) $obj["title"];
        $movie->date = $obj["release_date"];
        $movie->vote = (int) $obj["vote_average"];
        $movie->overview = (string) $obj["overview"];
        $movie->poster = "https://image.tmdb.org/t/p/w500" . (string) $obj["poster_path"];
        $movie->id = (int) $obj["id"];
        $movie->runtime = (string) $obj["runtime"];

        return $movie;
    }
}
