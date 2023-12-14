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

    
    public function FindOrders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll();

        return $this->respond($orders);
    }

}
