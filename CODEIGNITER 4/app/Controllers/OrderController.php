<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;
use App\Models\Addons;
use \App\Models\UserModel;

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
        $orderModel = new OrderModel();
    
        // Assuming UserModel is the user model
        $userModel = new \App\Models\UserModel();
    
        // Fetch the user ID based on your authentication method
        $userId = session()->get('token'); // Adjust this based on your authentication method
        $user = $userModel->find($userId);
    
        // Check if the user is found before associating the user ID with the order
        if ($user) {
            // Add the user ID to the order data
            $data['user_id'] = $userId;
    
            // Additional fields from the frontend (adjust these based on your actual field names)
            $data['sugar_variety'] = $data['sugar_variety'] ?? '';
            $data['sugar_level'] = $data['sugar_level'] ?? '';
            $data['size'] = $data['size'] ?? '';
    
            // Insert the order with the associated user ID and additional fields
            $orderModel->insert($data);
    
            return $this->respondCreated(['message' => 'Order submitted successfully']);
        } else {
            return $this->respond(['message' => 'User not found'], 404);
        }
    }
    
    public function FindOrders()
    {
        $orderModel = new OrderModel();
        $orders = $orderModel->findAll();
    
        // Fetch customer names or user ids for each order
        foreach ($orders as &$order) {
            if (array_key_exists('id', $order)) {
                $userModel = new \App\Models\UserModel(); // Assuming UserModel is the user model
                $user = $userModel->find($order['id']); // Replace 'user_id' with the actual foreign key in your orders table
    
                // Check if the user is found before accessing its properties
                if ($user) {
                    $order['username'] = $user['username']; // Replace 'username' with the actual field representing the customer name
                } else {
                    $order['username'] = 'Unknown User'; // Provide a default value or handle the case when the user is not found
                }
            }
        }
    
        return $this->respond($orders);
    }
    
    
    public function addons()
    {
        // Load the OrderModel
        $OrderModel = new Addons();

        // Retrieve all order products
        $data['orderProducts'] = $OrderModel->findAll();

        // Respond with the order products data
        return $this->respond($data['orderProducts']);
    }
    public function getOrderDetails($order_id)
    {
        $model = new OrderModel();
        $order = $model->getOrderDetails($order_id);

        if ($order) {
            return $this->respond($order);
        } else {
            return $this->failNotFound('Order not found');
        }
    }
    public function OrderDetails($order_id)
    {
        $model = new OrderModel();
        $order = $model->getOrderDetails($order_id);
    
        if ($order) {
            return $this->respond($order_id);
        } else {
            return $this->failNotFound('Order not found');
        }
    }
    public function cancelOrder()
    {
        $request = $this->request->getJSON();
    
        // Check if 'order_id' property exists in $request
        $order_id = property_exists($request, 'order_id') ? $request->order_id : null;
        $reason = property_exists($request, 'reason') ? $request->reason : null;
    
        // Validate input
        if (empty($order_id) || empty($reason)) {
            return $this->fail('Invalid input data');
        }
    
        // Load the OrderModel
        $orderModel = new OrderModel();
    
        // Fetch the order from the database
        $order = $orderModel->find($order_id);
    
        if (empty($order)) {
            return $this->fail('Order not found');
        }
    
        // Assume there is a 'status' column in your 'orders' table
        // Update the order status to 'cancelled'
        $data = [
            'status' => 'cancelled',
            'cancellation_reason' => $reason,
        ];
    
        try {
            $orderModel->update($order_id, $data);
    
            // You can perform additional actions here if needed
    
            return $this->respond(['message' => 'Order canceled successfully']);
        } catch (\Exception $e) {
            return $this->fail('Error canceling order: ' . $e->getMessage());
        }
    }
    public function deleteOrder($orderId)
    {
        $orderModel = new OrderModel();

        // Check if the order exists
        $order = $orderModel->find($orderId);

        if (!$order) {
            return $this->response->setStatusCode(ResponseInterface::HTTP_NOT_FOUND)->setJSON(['message' => 'Order not found']);
        }

        // Delete the order
        $orderModel->delete($orderId);

        return $this->response->setJSON(['message' => 'Order deleted successfully']);
    }


    
}
