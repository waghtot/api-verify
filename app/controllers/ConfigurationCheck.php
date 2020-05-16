<?php

class ConfigurationCheck extends Controller
{
    public function __construct($input = null)
    {
        if($input !== null){
            return $this->index($input);
        }
    }

    public function index($input)
    {
        $data = new stdClass();
        $data->action = $input->action;
        $data->projectId = $input->params->projectId;
        $res = ApiModel::getConfigByAction($data);
        return $res;
    }

}