<?php
namespace App\Controllers\Api;
use App\Controllers\BaseController;
use App\Models\OrderModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class OrderController extends ResourceController
{
    use ResponseTrait;

    public function addOrder()
    {
        $data = $this->request->getJSON();
        $productId = $data->product_id;

        // Assuming you have a ProductModel
        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($productId);

        if ($product) {
            // Assuming you have an OrderModel
            $orderModel = new OrderModel();
            $orderData = [
                'product_id' => $product['id'],
                'quantity'   => 1, // You may adjust the quantity as needed
                // Add other order-related fields as needed
            ];
            $orderModel->insert($orderData);

            // You may also update the product status or do other necessary actions
            // For example: $productModel->update($productId, ['status' => 'ordered']);

            return $this->respond(['message' => 'Order added successfully'], 200);
        } else {
            return $this->failNotFound('Product not found');
        }
    }
}
