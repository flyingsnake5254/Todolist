<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\TodoListModel;

class TodoListController extends BaseController
{
    use ResponseTrait;
    protected TodoListModel $todoListModel;

    public function __construct(){
        $this->todoListModel = new TodoListModel();
    }

    public function getAllData(){
        $data = $this->todoListModel->findAll();
        return $this->respond([
            "msg" => "success",
            "data" => $data
        ]);
    }

    public function getData(?int $id = null){
        if ($id === null){
            return $this->failNotFound('輸入 id 錯誤');
        }

        $data = $this->todoListModel->find($id);

        if ($data === null){
            return $this->failNotFound('此資料不存在');
        }

        return $this->respond([
            "msg" => "success",
            "data" => $data
        ]);

    }

    public function createData(){
        $data = $this->request->getJSON(); 
        $title = $data->title;
        $description = $data->description;
        $due = $data->due;

        if ($title === null || $description === null || $due === null){
            return $this->fail('pass in data is not found', 404);
        }

        $res = $this->todoListModel->insert([
            "title" => $title,
            "description" => $description,
            "due" => $due,
            "created" => date("Y-m-d H:i:s"),
            "updated" => date("Y-m-d H:i:s")
        ]);

        if ($res === false){
            return $this->fail("fail to create");
        }
        else{
            return $this->respond([
                "msg" => "create successfully",
                "data" => $res
            ]);
        }
    }

    public function updateData(?int $id = null){
        $data = $this->request->getJSON(); 
        $title = $data->title;
        $description = $data->description;
        $due = $data->due;

        if ($title === null || $description === null || $due === null){
            return $this->fail('pass in data is not found', 404);
        }

        $res = $this->todoListModel->find($id);

        if ($res === null) {
            return $this->failNotFound('此資料不存在');
        }

        // return $this->todoListModel->update([
        //     "title" => $title,
        //     "description" => $description,
        //     "due" => $due
        // ]);
        $this->todoListModel->update($id, [
            "title" => $title,
            "description" => $description,
            "due" => $due
        ]);
        
    }

    public function deleteData(?int $id = null){
        if ($id === null){
            return $this->failNotFound('輸入 id 錯誤');
        }

        $data = $this->todoListModel->find($id);

        if ($data === null){
            return $this->failNotFound('此資料不存在');
        }

        $this->todoListModel->delete($id);

    }
}
