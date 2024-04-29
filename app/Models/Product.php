<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const TOTAL_PAGE = 10;
    protected $fillable = ['name', 'description'];

    public function rules($id = 0)
    {
        return [
            'name'        => "required|min:3|max:100|unique:products,name,{$id},id",
            'description' => 'required|min:3|max:1000'
        ];
    }

    public function search($data)
    {
        return $this->where('name', $data['q'])
                    ->orWhere('description', 'LIKE',  '%' . $data['q'] . '%')
                    ->paginate(self::TOTAL_PAGE);
    }

}
