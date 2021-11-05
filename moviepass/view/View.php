<?php

namespace view;

use common\ClosureModel;
use InvalidArgumentException;

class View extends ClosureModel
{
    public function __construct(String $template, array $fields = array())
    {
        if ($template !== null) {
            $template = TEMPLATES_PATH . $template . ".php";
            if (!is_file($template) || !is_readable($template)) {
                throw new InvalidArgumentException(
                    "The template '$template' is invalid."
                );
            }
            $this->template = $template;
        } else
            throw new InvalidArgumentException(
                "The template does not exist."
            );

        if (!empty($fields)) {
            foreach ($fields as $name => $value) {
                $this->$name = $value;
            }
        }
    }

    private function render_()
    {
        extract($this->toArray());
        ob_start();
        include $this->template;
        return ob_get_clean();
    }

    public static function render(String $template, array $fields = array())
    {
        return (new View($template, $fields))->render_();
    }
}
