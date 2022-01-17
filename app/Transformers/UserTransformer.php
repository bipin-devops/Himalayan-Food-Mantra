<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform($data)
    {

        $result = [

            'username' => $data['username'],
            'email' => $data['email'],


        ];

        return $result;

    }


}