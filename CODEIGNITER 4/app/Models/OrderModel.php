<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'order_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields = ['customer_name', 'customer_address', 'product_name', 'status', 'product_description', 'product_price', 'quantity', 'total_amount', 'reason', 'sugar_variety', 'sugar_level', 'size', 'addons'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getOrdersByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }

    public function cancelOrder($order_id)
    {
        // Implement cancellation logic, for example, update the order status to canceled
        $data = ['status' => 'canceled'];
        $this->where('id', $order_id)->update($data);
    }
    public function getOrderDetails($orderId)
    {
        return $this->find($orderId);
    }
}
