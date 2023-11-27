<?php
namespace App\Controllers\Api;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Restful\ResourceController;
use App\Controllers\BaseController;
use App\Models\UserList;

class UserListController extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Userlist();
        $data['userlist'] = $model->findAll();
        return $this->respond($data);
    }

    public function create()
    {
        // Implement user creation logic here
    }

    public function update($id)
    {
        // Implement user update logic here
    }

    public function delete($id)
    {
        // Implement user deletion logic here
    }
}
