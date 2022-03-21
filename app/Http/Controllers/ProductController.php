<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{

    protected $productService;


    /**
     * ProductService Constructor
     * 
     * @var $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * this method returns all objects
     * 
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $result = ['status' => 200];

        try{
            $result['data'] = $this->productService->index();
        } catch(Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }


    /**
     * method to create the product
     * 
     * @param Request $request
     */
    public function store(Request $request){

        $data = $request->only([
            'name',
            'description'
        ]);

        $result = ['status' => 200];

        try{
            $result['data'] = $this->productService->storeData($data);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);    
    }

    /**
     * display a specified product
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $result = ['status' => 200];
        
        try {
            $result['data'] = $this->productService->getById($id);
        } catch (Exception $e){
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    /**
     * update the product
     *
     * @param Request
     * @param id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request([
            'name' => 'required',
            'description' => 'required'
        ]);

        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->updateProduct($data, $id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);

    }

    /**
     * 
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->productService->deleteById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }
}
