<?php

class CheckUser extends Controller
{
    public function index($input)
    {
        return $this->getUserInfo($input);
    }

    public function getUserInfo($input){

        $data = new stdClass();
        $data->api = 'database';
        $data->connection = 'CORE';
        $data->procedure = __FUNCTION__;
        $data->params->email = $input->email;
        $data->params->projectId = $input->projectId;
        $res = json_decode(API_model::doAPI($data));
        return $res[0];

    }

}