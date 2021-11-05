<?php

namespace common;

use Closure;

class ClosureModel
{
    protected $fields = array();

    public function __set($name, $value)
    {
        $this->fields[$name] = $value;
        return $this;
    }

    public function __get($name)
    {
        if (isset($this->fields[$name])) {
            $field = $this->fields[$name];
            return $field instanceof Closure ? $field($this) : $field;
        }
    }

    public function __isset($name)
    {
        return isset($this->fields[$name]);
    }

    public function __unset($name)
    {
        if (isset($this->fields[$name]))
            unset($this->fields[$name]);

        return $this;
    }

    public function toArray()
    {
        return $this->fields;
    }

    public static function fromJson($obj)
    {
        $closureModel = new ClosureModel();
        if (isset($obj)) {
            foreach ($obj as $key => $value) {
                $closureModel->$key = $value;
            }
        }

        return $closureModel;
    }
}
