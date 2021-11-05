<?php

namespace model\dao\Api;

use common\ClosureModel;
use model\models\Movie as MMovie;

use ErrorException;
use Exception;

class Movie
{
  private static function makeRequest($url)
  {
    try {
      set_error_handler(
        function ($severity, $message, $file, $line) {
          throw new ErrorException($message, $severity, $severity, $file, $line);
        }
      );
      $response = file_get_contents($url);
      $jsonresponse = (array) json_decode($response,  true);
    } catch (Exception $e) {
      throw new Exception('Themoviedb API returned an error: ' . $e->getMessage(), 1);
    } finally {
      restore_error_handler();
    }

    if (isset($jsonresponse['success']) && $jsonresponse['success'] === false) {
      return null;
    } else {
      return ($jsonresponse) ? $jsonresponse : [];;
    }
  }

  private static function parseResponse($jsonresponse)
  {
    if ($jsonresponse == null)
      return [];

    $closureModel = new ClosureModel();
    $closureModel->pages = $jsonresponse["total_pages"];
    $closureModel->movies = array_map(function (array $moviearr) {
      $movie = MMovie::fromApi($moviearr);
      $movie->genres = Genre::getGenresByIds($moviearr['genre_ids']);

      return $movie;
    }, $jsonresponse['results']);

    return $closureModel;
  }

  public static function getPage(int $page)
  {
    return Movie::parseResponse(Movie::makeRequest(
      "https://api.themoviedb.org/3/movie/now_playing?page=" . $page . "&language=en-US&api_key=" . API_KEY
    ));
  }

  public static function searchByName(int $page, String $name)
  {
    return Movie::parseResponse(Movie::makeRequest(
      "https://api.themoviedb.org/3/search/movie?api_key=" . API_KEY . "&language=en-US&query=" . urlencode($name) . "&page=" . $page . "&include_adult=true"
    ));
  }

  public static function searchByDateAndGenre(int $page, String $year, array $wGenres, array $woGenres)
  {
    $wGenres_ =  '';
    $woGenres_ = '';
    $year_ = '';

    if (!empty($wGenres))
      $wGenres_ = "&with_genres=" . implode(',', $wGenres);

    if (!empty($woGenres))
      $woGenres_ = "&without_genres=" . implode(',', $woGenres);

    if ($year > 0) {
      $dateObj = \DateTime::createFromFormat("Y", $year);
      if (!$dateObj)
        throw new \UnexpectedValueException("Could not parse the date: " . $year);

      $year_ = "&year=" . $dateObj->format("Y");
    }

    return Movie::parseResponse(Movie::makeRequest(
      "https://api.themoviedb.org/3/discover/movie?api_key=" . API_KEY . "&language=en-US&sort_by=popularity.desc&page=" . $page . $year_ . $wGenres_ . $woGenres_
    ));
  }

  public static function getById(int $id)
  {
    $jsonresponse = Movie::makeRequest(
      "https://api.themoviedb.org/3/movie/" . $id . "?api_key=" . API_KEY . "&language=en-US"
    );

    //Parsing response
    {
      $jsonresponse["runtime"] = (string) date('H:i:s', mktime(0, $jsonresponse["runtime"]));

      $movie = MMovie::fromApi($jsonresponse);
      $movie->genres = Genre::getGenresByIds($jsonresponse['genres']);

      return $movie;
    }
  }
}
