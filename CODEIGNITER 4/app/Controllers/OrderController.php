<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class OrderController extends BaseController
{
    public function getBestSellers()
    {
        // Example: Get the best-selling products based on the total quantity sold
        $builder = $this->db->table('orders');
        $builder->select('product_id, SUM(quantity) as total_sold');
        $builder->groupBy('product_id');
        $builder->orderBy('total_sold', 'DESC');
        $builder->limit(5); // Adjust the limit based on the number of best sellers you want

        $query = $builder->get();
        return $query->getResult();
    }
}
