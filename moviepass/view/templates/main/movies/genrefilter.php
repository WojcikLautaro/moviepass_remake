<?php

use Model\Models\Genre;
?>

<div class="card">
    <div class="card-header">
        <h2>
            <button class="btn btn-outline-success my-2 my-sm-0" class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $cardId; ?>" aria-expanded="false">
                <?php echo $cardTitle; ?>
            </button>
        </h2>
    </div>
    <div id="<?php echo $cardId; ?>" class="collapse">
        <div class="card-body">
            <div class="container">
                <?php foreach ($searchGenres as $genre) {
                    if ($genre instanceof Genre) {
                ?>
                        <input <?php if (in_array($genre->id, $checkedArray)) echo 'checked'; ?> type="checkbox" class="form-check-input" id="gnr<?php echo $genre->id; ?>" name="<?php echo $inputName; ?>" value="<?php echo $genre->id; ?>">
                        <label class="form-check-label" for="gnr<?php echo $cardId . $genre->id; ?>"> <?php echo $genre->name; ?></label><br>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>