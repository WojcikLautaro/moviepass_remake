<?php ?>

<table class="table">
    <thead>
        <tr>
            <?php
            foreach ($tableheaders as $th) {
                echo '<th scope="col">' . $th . '</th>';
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($tablerows as $tr) {
            echo '<tr>';
            foreach ($tr as $td) {
                echo '<td>';
                echo $td;
                echo '</td>';
            }

            echo '</tr>';
        }
        ?>
    </tbody>
</table>