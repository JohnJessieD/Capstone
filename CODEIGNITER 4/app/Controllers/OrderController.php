<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class OrderController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        // Load the OrderModel
        $OrderModel = new OrderModel();

        // Retrieve all order products
        $data['orderProducts'] = $OrderModel->findAll();

        // Respond with the order products data
        return $this->respond($data['orderProducts']);
    }

    public function orders()
    {
        // Retrieve orders from the database and return them as JSON
        $orders = $this->OrderModel->table('orders')->get()->getResult();
        return $this->respond($orders);
    }


    public function submitOrder()
    {
        $data = $this->request->getJSON(true);

        // Assuming you have a model named OrderModel
        $OrderModel = new OrderModel();
        $OrderModel->insert($data);

        return $this->respondCreated(['message' => 'Order submitted successfully']);
    }

    
    public function search()
{
    $request = $this->request->getJSON();

    // Check if $request is not null and has the property "searchQuery"
    if ($request && property_exists($request, 'searchQuery')) {
        $searchQuery = $request->searchQuery;

        // Validate the search query if needed

        $model = new ProductModel();

        // Check if a search query is provided
        if ($searchQuery) {
            // If a search query is provided, perform a search
            $result = $model->like('name', $searchQuery)->findAll();
        } else {
            // If no search query is provided, get all products
            $result = $model->findAll();
        }

        return $this->respond($result, 200);
    } else {
        // Handle the case when "searchQuery" is not provided in the request
        return $this->respond(['error' => 'Invalid search request'], 400);
    }
}

    

    public function highestBoughtProduct()
    {
        $orderModel = new OrderModel();
        $highestBoughtProduct = $orderModel->getHighestBoughtProduct();

        if ($highestBoughtProduct) {
            return $this->respond($highestBoughtProduct, Response::HTTP_OK);
        } else {
            return $this->failNotFound('No highest bought product found.');
        }
    }   
}
