<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;

class ProductsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            "name"  => $row['name'],
            "description"  => $row['description'],
            "image"  => $row['image'],
            "barcode"  => $row['barcode'],
            "price"  => $row['price'],
            "quantity"  => $row['quantity'],
            "status" => 1,
            
        ]);
    }
}
