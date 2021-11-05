<?php

use view\View;
use model\models\User;
use common\ClosureModel;

$modalSignOptions = new ClosureModel();
$modalSignOptions->modalId = "sign-options";
$modalSignOptions->buttonClass = "btn nav-link";

switch ((isset($user) && $user instanceof User) ? "signedin" : "signedout") {
    case "signedin":
        $portrait = View::render("navbar\\sign\\portrait", ["src" => $user->portrait]);
        $modalSignOptions->buttonInner = $portrait;
        $modalSignOptions->modalHeader = $portrait;
        $modalSignOptions->modalBody = View::render("navbar\\sign\\signedin");

        break;

    case "signedout":
    default:
        $modalSignOptions->buttonInner = "Sign In";
        $modalSignOptions->modalBody = View::render("navbar\\sign\\signedout", ["accordionId" => "sign-options-accordion"]);
        break;
}

echo View::render("base\\modal", $modalSignOptions->toArray());
