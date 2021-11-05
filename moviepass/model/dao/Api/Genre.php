<?php

namespace model\dao\Api;

use model\models\Genre as MGenre;
use ErrorException;
use Exception;

class Genre
{
    private static $genres = null;

    public static function getGenres()
    {
        if (empty(self::$genres)) {
            try {
                set_error_handler(
                    function ($severity, $message, $file, $line) {
                        throw new ErrorException($message, $severity, $severity, $file, $line);
                    }
                );

                $response = file_get_contents('https://api.themoviedb.org/3/genre/movie/list?api_key=' . API_KEY . '&language=en-US');
                $jsonresponse = (array) json_decode($response, true);
            } catch (Exception $e) {
                throw new Exception('Themoviedb API returned an error: ' . $e->getMessage(), 1);
            } finally {
                restore_error_handler();
            }

            if (isset($jsonresponse['success']) && $jsonresponse['success'] === false) {
                self::$genres = [];
            } else {
                $jsonresponse = ($jsonresponse) ? $jsonresponse : array();

                self::$genres = array_map(function (array $genre) {
                    return MGenre::fromApi($genre);
                }, $jsonresponse['genres']);
            }
        }

        return self::$genres;
    }

    public static function getGenreById(int $id)
    {
        $toReturn = 'Genere';
        foreach (Genre::getGenres() as $value) {
            if ($value instanceof MGenre) {
                if ($value->id == $id) {
                    $toReturn = $value;
                }
            }
        }

        return $toReturn;
    }

    public static function getGenreByName(String $name)
    {
        $toReturn = 'Genere';
        foreach (Genre::getGenres() as $value) {
            if ($value instanceof MGenre) {
                if ($value->name == $name) {
                    $toReturn = $value;
                }
            }
        }

        return $toReturn;
    }

    public static function getGenresByIds($ids)
    {
        $genrearr = [];
        foreach ($ids as $genre) {
            array_push($genrearr, Genre::getGenreById($genre));
        }

        return $genrearr;
    }
}
