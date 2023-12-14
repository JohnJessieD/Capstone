<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Restful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;

class Usercontroller extends ResourceController
{
    use ResponseTrait;

    public function register()
    {
        $user = new UserModel();
        $token = $this->verification(50);
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'token' => $token,
            'status' => 'active',
            'role' => 'user','admin'
        ];
        $u = $user->save($data);
        if ($u) {
            return $this->respond(['msg' => 'okay', 'token' => $token]);
        } else {
            return $this->respond(['msg' => 'failed']);
        }
    }

    public function verification($length)
    {
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length);
    }

    public function login()
    {
        $user = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $user->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                return $this->respond(['msg' => 'okay', 'token' => $data['token']]);
            } else {
                return $this->respond(['msg' => 'error'], 200);
            }
        }
    }

    public function users($id = null)
    {
        $model = new UserModel();
        $users = $model->findAll();

        return $this->respond($users);
    }

    public function create_user()
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'), // Assuming 'name' is a field in your 'users' table
            // Add other fields as needed
        ];

        $userModel->insert($data);

        return $this->respond(['msg' => 'User created successfully']);
    }

    public function update_user($id)
    {
        $userModel = new UserModel();
        $data = [
            'username' => $this->request->getVar('username'),
            'role' => $this->request->getVar('role'), // Add other fields as needed
        ];
    
        $userModel->update($id, $data);
    
        return $this->respond(['msg' => 'User updated successfully']);
    }

    public function delete_user($id)
    {
        $userModel = new UserModel();
        $userModel->delete($id);

        return $this->respond(['msg' => 'User deleted successfully']);
    }

    public function getUsersCount()
    {
        // Assuming you have a User model
        $userModel = new \App\Models\UserModel();
        $count = $userModel->countAllResults();

        return $this->respond(['count' => $count]);
    }   




    public function getUserProfile()
    {
        // Retrieve the logged-in user's data
        $userId = session()->get('token'); // You should adjust this based on your authentication method
        $userModel = new UserModel();
        $userData = $userModel->find($userId);

        return $this->respond($userData);
    }

    public function updateUserProfile()
    {
        $userId = session()->get('token'); // You should adjust this based on your authentication method
        $userModel = new UserModel();

        $data = [
            'username' => $this->request->getVar('name'),
            'password' => $this->request->getVar('email'),
            'status' => $this->request->getVar('phone'),
            // You can remove the old keys or keep them as they are
            // 'address' => $this->request->getVar('address'),
            // 'birthdate' => $this->request->getVar('birthdate'),
            // 'gender' => $this->request->getVar('gender'),
        ];
        

        // Update the user profile
        $userModel->update($token, $data);

        return $this->respond(['message' => 'Profile updated successfully']);
    }
}
