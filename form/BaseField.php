<?php

namespace app\core\form;

use app\core\Model;

abstract class BaseField
{
    public Model $model;
    public string $attribute;
    /**
     * Summary of __construct
     * @param \app\core\Model $model
     * @param string $attribute
     */
    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    abstract public function renderInput() : string;
    public function __toString()
    {
        return sprintf('
            <label class="col-sm-2 col-form-label">%s</label>
            <div class="col-sm-10">
                %s
                <div class="invalid-feedback">%s</div>
            </div>
        ',
            $this->model->labels()[$this->attribute] ?? $this->attribute,
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
