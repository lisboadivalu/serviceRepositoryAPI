<?php 

namespace App\Repository;

use App\Models\Product;


class ProductRepository {

    protected $product;

    /**
     * PostRepository constructor
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    /**
     * 
     * @return Product $product
     */
    public function index()
    {
        return $this->product->get();
    }

    /**
     * this method created
     * 
     * @param $data
     * @return Product
     */
    public function save($data)
    {  
        $product = new $this->product;
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->save();

        return $product->fresh();
    }

    /**
     * 
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return $this->product->where('id', $id)->get();
    }

    /**
     * Update product
     * 
     * @param $data
     * @return Post
     */
    public function update($data, $id)
    {

        $product = $this->product->find($id);

        $product->name = $data['name'];
        $product->description = $data['description'];

        $product->update();

        return $product;

    }


    /**
     * Delete product
     * 
     * 
     * @param $data
     * @return Product
     */

    public function delelete($id)
    {
        $product = $this->product->find($id);
        $product->delete();

        return $product;
    }


}