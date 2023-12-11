<?php

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use App\Models\BranchModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use App\Controllers\BaseController;
class BranchController extends ResourceController
{
    use ResponseTrait;

    private $branchModel;

    public function __construct()
    {
        // Use dependency injection to inject the BranchModel
        $this->branchModel = new BranchModel();
    }

    public function index()
    {
        try {
            // Fetch branches from the database
            $branches = $this->branchModel->findAll();

            return $this->respond($branches);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred while fetching branches.');
        }
    }

    public function create()
    {
        try {
            // Get the request data
            $data = $this->request->getPost();

            // Validate the data
            if (!$this->validateData($data)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }

            // Insert into the database
            $this->branchModel->insert($data);

            return $this->respondCreated(['message' => 'Branch created successfully']);
        } catch (\Exception $e) {
            return $this->failServerError('An error occurred while creating the branch.');
        }
    }

    /**
     * Validate branch creation data.
     *
     * @param array $data
     * @return bool
     */
    private function validateData(array $data): bool
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'name'    => 'required',
            'address' => 'required',
            'phone'   => 'required',
        ]);

        return $validation->run($data);
    }
}
