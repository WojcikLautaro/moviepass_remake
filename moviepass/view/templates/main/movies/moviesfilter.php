<?php

use Model\Models\ClosureModel;
use Views\View;
?>

<form onsubmit="<?php echo $onSubmit; ?>">
    <div class="card">
        <div class="card-header">
            <h2><button class="btn btn-outline-success my-2 my-sm-0" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#search-options-filter" aria-expanded="false">
                    Search options
                </button></h2>
        </div>

        <div class="card-body collapse" id="search-options-filter">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Movie name" name="searchName" value="<?php echo $searchName ?>">
            </div>
            <br>
            <?php
            $genrefilter = new ClosureModel();
            $genrefilter->cardTitle = "Included genres";
            $genrefilter->cardId = "includedGenresCard";
            $genrefilter->inputName = "genresIncluded";
            $genrefilter->searchGenres = $searchGenres;
            $genrefilter->checkedArray = $searchGenresIncluded;

            echo View::render("main\\movies\\genrefilter", $genrefilter->toArray());
            ?>
            <br>
            <?php
            $genrefilter = new ClosureModel();
            $genrefilter->cardTitle = "Excluded genres";
            $genrefilter->cardId = "excludedGenresCard";
            $genrefilter->inputName = "genresExcluded";
            $genrefilter->searchGenres = $searchGenres;
            $genrefilter->checkedArray = $searchGenresExcluded;

            echo View::render("main\\movies\\genrefilter", $genrefilter->toArray());
            ?>
            <br>
            <div class="input-group">
                <input type="text" inputmode="number" pattern="\d{4}" class="form-control" name="searchYear" placeholder="Year of release" value=<?php echo $searchYear ?>>
            </div>
        </div>
    </div>

    <br>

    <div class="input-group">
        <?php if ($searchPage > 1) { ?>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchPage" value="<?php echo $searchPage - 1 ?>">Prev Page</button>
        <?php } ?>
        <input name="searchPage" type="number" value="<?php echo $searchPage ?>" class="form-control" placeholder="Page number">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Go</button>
        <?php if ($searchPage < $searchMaxPage) { ?>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="searchPage" value="<?php echo $searchPage + 1 ?>">Next Page</button>
        <?php } ?>
    </div>
</form>