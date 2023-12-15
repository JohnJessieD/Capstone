<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\SalesModel;
use App\Models\AuditModel;
use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\ProductModel;
use CodeIgniter\API\ResponseTrait;


class ProductController extends ResourceController
{
    use ResponseTrait;

    public function __construct()
{
    $this->ProductModel = new \App\Models\ProductModel(); // Adjust based on your actual model class
}
    public function updateProduct($id)
    {
      $data = $this->request->getJSON();
       $model = new ProductModel();
       $model->update($id, $data);

       return $this->respond(['status' => 'success', 'message' => 'Product updated successfully']);
    }
    public function newproduct()
    {
      $data = $this->request->getJSON();
        $model = new ProductModel();
        $model->insert($data);
    }
    public function getSales($id)
    {
      $sales = new SalesModel();
      $data = $sales->select('name as name, sales.price as price, sales.quantity as quantity')->join('products', 'sales.productID=products.id')->where('orderID', $id)->findAll();
      return $this->respond($data, 200);
    }
    public function audit($id)
    {
      $audit = new AuditModel();
      $data = $audit->select('products.upc as upc, products.name as name, products.description as description, audit.oldQuantity as oldQuantity, audit.quantity as quantity, audit.type as type')->join('products', 'audit.productID=products.id')->where('products.upc', $id)->findAll();
      return $this->respond($data,200);
    }
    public function updateQuantity()
    {
      $upc = $this->request->getVar('upc');
      $quantity = $this->request->getVar('quantity');
      $product = new ProductModel();
      $audit = new AuditModel();
      $pr = $product->where('upc', $upc)->first();
      if($pr){
        $nq = $pr['quantity'] + $quantity;
        $product->set('quantity', $nq)->where('upc', $upc)->update();
        $data = [
          'productID' =>$pr['id'],
          'oldQuantity' =>$pr['quantity'],
          'quantity' => $quantity,
          'type' => 'inbound'
        ];
        $audit->save($data);
      }

    }

    public function setsales($id)
    {
      $sales =new SalesModel();
      $product  = new ProductModel();
      $audit = new AuditModel();
      // $sales->set('status', 'transacted')->where('orderID', $id)->update();
      $d = $sales->where('orderID', $id)->findAll();
      foreach ($d as $v) {
        $pid = $v['productID'];
        $quantity = $v['quantity'];
        $h = $product->where('id', $pid)->first();
        $sets = [
          'quantity' => $h['quantity'] - $quantity
        ];
        $data = [
          'productID' => $pid,
          'oldQuantity' => $h['quantity'],
          'quantity' => $quantity,
          'type' =>'sales'
        ];
        $product->set($sets)->where('id', $pid)->update();
        $audit->save($data);
      }
      $sales->set('status', 'transacted')->where('orderID', $id)->update();
    }
    public function isales()
    {
      $upc = $this->request->getVar('upc');
      $qty = $this->request->getVar('quantity');
      $orderID = $this->request->getVar('orderID');
      $product = new ProductModel();
      $pr = $product->where('upc', $upc)->first();
      $sales = new SalesModel();
      if($pr){
        $data = [
          'orderID' =>$orderID,
          'productID' => $pr['id'],
          'price' => $pr['price'],
          'quantity' =>$qty,
          'status' => 'added'
        ];
        $d = $sales->save($data);
        $message = "added";
      }else{
        $message = "no_result";
      }
      //
      return $this->respond($message, 200);
    }

    
    public function getProductsCount()
    {
        $productModel = new ProductModel();
        $count = $productModel->countAllResults();

        return $this->respond(['count' => $count]);
    }

    public function Products()
    {
      $model = new ProductModel();
      $products = $model->findAll();

      return $this->respond($products);
    }
        
    public function getCategories()
    {
        $productModel = new ProductModel();
        $data['categories'] = $productModel->distinct('category')->findAll();
        return $this->respond($data);
    }
    
    public function submitOrder()
    {
        $orderModel = new OrderModel();
        $data = $this->request->getJSON();
        $orderModel->insert($data);
        return $this->respondCreated(['message' => 'Order submitted successfully']);
    }
   
    private function searchInDatabase($query)
    {
        // Replace this with your database query or any other search logic
        // Example: Fetch products with names containing the search query
        $model = new \App\Models\ProductModel();
        $result = $model->like('name', $query)->findAll();

        return $result;
    }
    public function highestBoughtProduct()
    {
        // Replace this with your actual logic to fetch products with many sales from the database
        $productModel = new ProductModel();
        $products = $productModel->orderBy('quantity', 'desc')->limit(5)->findAll();

        return $this->respond($products);
    }

    public function orderProducts()
    {
        // Assuming you have an OrderProductsModel to fetch ordered products from the database
        $orderProductsModel = new OrderModel();
        $orderedProducts = $orderProductsModel->findAll(); // You may need to adjust this based on your actual database structure

        return $this->response->setJSON($orderedProducts);
    }
    public function search()
    {
      $data = [
        'name' => $this->request->getVar('name'),
            'price' => $this->request->getVar('price'),
      ];
      $model = new ProductModel();

      if ($this->request->getMethod() === 'post') {
          $keyword = $this->request->getPost('search');
          $data['results'] = $model->like('name', $keyword)
                                  ->orLike('price', $keyword)
                                  ->findAll();
      }

      return view('search/index', $data);
    }

    public function addProduct()
    {
        $productModel = new ProductModel();
    
        // Assuming you're receiving data via JSON request
        $data = $this->request->getJSON();
    
        $productModel->insert($data);
        return $this->respondCreated(['message' => 'Product added successfully']);
    }
public function index()
  {
        $orderModel = new OrderModel();

        // Get the status filter from the query parameters
        $status = $this->request->getGet('status');

        // If status is provided, filter orders by status
        if ($status) {
            $orders = $orderModel->where('status', $status)->findAll();
        } else {
            // Otherwise, fetch all orders
            $orders = $orderModel->findAll();
        }

        return $this->respond($orders);
    }

    // Update order status
    public function update($id = null)
    {
        $orderModel = new OrderModel();

        // Fetch the order
        $order = $orderModel->find($id);

        if (!$order) {
            return $this->failNotFound('Order not found');
        }

        // Extract the new status from the request data
        $newStatus = $this->request->getJSON()->status;

        // Validate the new status (you may add more validation)
        if (!in_array($newStatus, ['ongoing', 'delivered'])) {
            return $this->fail('Invalid status provided');
        }

        // Update the order status
        $orderModel->update($id, ['status' => $newStatus]);

        // Respond with success message or updated order
        return $this->respondUpdated(['status' => 'Order status updated successfully']);
    }


    

public function removeProduct($id)
{
    $productModel = new ProductModel();
    $product = $productModel->find($id);

    if ($product) {
        $product->delete();
        return response()->json(['msg' => 'Product deleted successfully']);
    } else {
        return response()->json(['msg' => 'Product not found'], 404);
    }
}

public function getChartData()
{
    $productModel = new ProductModel();
    $chartData = $productModel->select('name, SUM(quantity) as totalQuantity')
                            ->groupBy('name')
                            ->findAll();

    return $this->respond($chartData);
}


  }