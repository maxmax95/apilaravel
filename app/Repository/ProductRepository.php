<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class ProductRepository
{

    private $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function selectConditions($conditions)
    {
            $conditions = explode(';', $conditions);
            foreach($conditions as $condition){
                $ci = explode(':',$condition);
                $this->model = $this->model->where($ci[0],$ci[1], $ci[2]);

            }
    }

    public function selectFilter($filters)
    {
       
            $this->model = $this->model->selectRaw($filters);

    }

    public function getResult()
    {
        return $this->model;
    }
}
