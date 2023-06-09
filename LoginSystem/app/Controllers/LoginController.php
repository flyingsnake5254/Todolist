<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginModel;
use CodeIgniter\API\ResponseTrait;

class LoginController extends BaseController
{
    use ResponseTrait;

    protected LoginModel $loginModel;

    public function __construct(){
        $this->loginModel = new LoginModel();
    }
    
    public function login(){
        $data = $this->request->getJSON();

        $account = $data->account;
        $password = $data->password;

        if(empty($account) || empty($password)){
            return $this->fail("輸入不可為空");
        }

        $res = $this->loginModel->where("account", $account)->first();

        if(!$res){
            return $this->respond([
                "msg"=>"fial to login"
            ]);
        }

        if ($res['password'] !== $password){
            return $this->respond([
                "msg"=>"fial to login"
            ]);
        }
        
   
        
        return $this->respond([
            "msg"=>"success",
            "userid"=>$res['id']
        ]);
    }


    public function createAccount(){
        $data = $this->request->getJSON(); 
        $account = $data->account;
        $password = $data->password;

        if ($account === null || $password === null){
            return $this->respond([
                "msg" => "輸入錯誤"
            ]);
        }

        if ($this->loginModel->where('account', $account)->first() !== null){
            return $this->respond([
                "msg" => "帳號已經存在"
            ]);
        }

        $res = $this->loginModel->insert([
            "account" => $account,
            "password" => $password,
            "created" => date("Y-m-d H:i:s"),
            "updated" => date("Y-m-d H:i:s")
        ]);

        if ($res === false){
            return $this->respond([
                "msg" => "建立失敗"
            ]);
        }
        else{
            return $this->respond([
                "msg" => "建立成功",
                "data" => $res
            ]);
        }
    }

}
