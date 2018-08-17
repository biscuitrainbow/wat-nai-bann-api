<?php
namespace App\Transformer;

class UserTransformer extends Transformer
{
    protected $resourceName = 'user';

    public function transform($data)
    {
        return [
            'email' => $data['email'],
            'name' => $data['name'],
            'gender' => $data['gender'],
            'tel' => $data['tel'],
            'date_of_birth' => $data['date_of_birth'],
        ];
    }
}