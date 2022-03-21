<?php

namespace App\Services;

use App\Repository\ProductRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class ProductService {


    /**
     * @var $productRepository
     * 
     */
    protected $productRepository;


    /**
     * ProductService constructor
     * 
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * display all data
     * 
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $result = ['status' => 200];

        try{
            $result['data'] = $this->productRepository->index();
        } catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * @param array $data
     * @return string
     */
    public function storeData($data)
    {
        $validator = Validator::make($data, [
            'name' => 'required',
            'description' => 'required'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        } 

        $result = $this->productRepository->save($data);

        return $result;

    }


    /**
     * get product by id
     * 
     * @param $id
     * @return string
     */
    public function getById($id)
    {
        return $this->productRepository->getById($id);
    }

    /**
     * 
     * @param array $data
     * @return string
     */
    public function updateProduct($data, $id)
    {
        $validator = Validator::make([
            'name' => 'bail|min:2',
            'description' => 'bail|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        DB::beginTransaction();

        try {
            $product = $this->productRepository->update($data, $id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

            throw new InvalidArgumentException('Unable to update product data!');
        }

        DB::commit();

        return $product;

    }

    /**
     * 
     * @param $id
     * @return string
     */
    public function deleteById($id)
    {

        DB::beginTransaction();

        try {
            $product = $this->productRepository->delete($id);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
        }

        DB::commit();

        return $product;

    }

}