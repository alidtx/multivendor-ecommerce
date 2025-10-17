<?php
// Developer: Ali Abu Taleb | Reviewed: 2025-10-17


namespace App\Repositories;


use App\Models\Product;
use Illuminate\Support\Collection;


class ProductRepository
{
protected Product $model;


public function __construct(Product $product)
{
$this->model = $product;
}


/**
* Find product by id with for update lock when inside transactions.
*/
public function findForUpdate(int $id): ?Product
{
return $this->model->where('id', $id)->lockForUpdate()->first();
}


public function reduceStock(Product $product, int $qty): void
{
$product->decrement('stock_quantity', $qty);
$product->refresh();
}


public function find(int $id): ?Product
{
return $this->model->find($id);
}
}