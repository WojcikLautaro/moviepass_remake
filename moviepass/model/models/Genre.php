<?php

namespace Model\Models;

use Model\Models\ClosureModel;

class Genre extends ClosureModel
{
    public static function fromApi(array $obj)
    {
        $genre = new Genre();
        $genre->id = (string) $obj["id"];
        $genre->name = (string) $obj["name"];

        return $genre;
    }
}
