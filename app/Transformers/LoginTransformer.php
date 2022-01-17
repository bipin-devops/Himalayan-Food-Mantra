<?php


namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class LoginTransformer extends TransformerAbstract
{
    public function transform($data)
    {
        return $data;
    }

}