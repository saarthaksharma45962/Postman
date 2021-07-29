<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;

class Customer extends ResourceController
{
    use ResponseTrait;
    
    public function __construct()
    {
        $this->request = \Config\Services::request();
    }

    //get all records
    public function index()
    {
        $apimodel = new ApiModel();
        $data = $apimodel->findAll();
        return $this->respond($data);
    }

    public function create()
    {
        $apimodel = new ApiModel();
        $data = [
            'Name' => $this->request->getVar('Name'),
            'Email' => $this->request->getVar('Email')
        ];
        
        $apimodel->insert($data);
        $response = [
            'status' => 201,
            'error' => null,
            'messages' => [
                'success' => "Customer created"
            ],
        ];

        return $this->respondCreated($response);
    }

    public function getCustomer($id=null)
    {
        $apimodel = new ApiModel();
        $data = $apimodel->where('ID', $id)->first();
        if ($data) {
            return $this->respond($data);
        } else {
            return $this->failNotFound('Customer does not exist');
        }
    }

    public function update($id=null)
    {

        $apimodel = new ApiModel();
        $id = $this->request->getVar('ID');
        $data = [
            'Name' => $this->request->getVar('Name'),
            'Email' => $this->request->getVar('Email')
        ];
        $apimodel->update($id, $data);
        $response = [
            'status' => 200,
            'error' => null,
            'messages' => [
                'success' => 'Customer information updated'
            ],
        ];
        return $this->respond($response);
    }

    public function delete($id=null)
    {
        $apimodel = new ApiModel();
        $data = $apimodel->where('ID', $id)->find($id);
        if ($data) {
            $apimodel->delete($data);
            $response = [
                'status' => 200,
                'error' => null,
                'message' => [
                    'success' => 'Record deleted'
                ]
            ];
            return $this->respondDeleted($response);
        } else{

            return $this->failNotFound('Customer does not exist');
        }
    }
}
