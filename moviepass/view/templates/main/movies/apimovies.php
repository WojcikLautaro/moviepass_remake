<?php

use Model\Models\ClosureModel;
use Views\View;
?>

<h1 class="mt-5">Movies from Api</h1>
<br>
<label for="basic-url"><small style="color:black;">*Search either by name or date and genres.</small></label>

<?php
$moviesfilter = new ClosureModel();
$moviesfilter->searchPage = $searchPage;
$moviesfilter->searchMaxPage = $searchMaxPage;
$moviesfilter->searchName = $searchName;
$moviesfilter->searchYear = $searchYear;
$moviesfilter->searchGenresIncluded = $searchGenresIncluded;
$moviesfilter->searchGenresExcluded = $searchGenresExcluded;
$moviesfilter->searchGenres = $searchGenres;
$moviesfilter->onSubmit = "test(this, event)";

echo View::render("main\\movies\\moviesfilter", $moviesfilter->toArray());


$moviestable = new ClosureModel();
$moviestable->movies = $movies;

$inputs = array();
array_push($inputs, function (int $movieid, array $params = []) {
    if (!$params["currMov"][$movieid])
        return '<td><div class="col-auto">
                        <input type="checkbox" class="form-check-input" id="mov' . $movieid . '" name="mov[]" value="' . $movieid . '">
                        <label class="form-check-label" for="mov' . $movieid . '">Add</label><br>
                </div></td>';

    else return '<td><div class="col-auto"></div></td>';
});

$moviestable->inputs = $inputs;
$moviestable->params = array("currMov" => $currMov);
?>

<form method="POST">
    <?php echo View::render("main\\movies\\moviestable", $moviestable->toArray()); ?>
    <button class="btn btn-outline-success my-2 my-sm-0" formaction="<?php echo FRONT_ROOT ?>movies/add" type="submit">Add</button>
</form>

<br>
<br>