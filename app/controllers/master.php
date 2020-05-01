<?php 

class Master extends Controller
{


    public function __construct()
    {
        $this->setRequest();
        return $this->index();
    }

    public function index()
    {

        if($this->getRequest() !== false)
        {

            $data = $this->getRequest();

            if(isset($data->action))
            {
                switch($data->action)
                {
                    case 'Login':
                        $data->config = $this->configLogin($data);
                        echo json_encode($this->validateInput($data->config));
                    break;
                }
            }
        }
    }

    private function configLogin($input)
    {
        $cnf = json_decode(ConfigurationCheck::index($input));
        if(!empty($cnf))
        {
            unset($input->action);
            unset($input->params->projectId);
            $data = new stdClass();
            $data->find = $input->params;
            $data->cnf = $cnf;
            return $data;
        }

        return false;
    }

    private function validateInput($input)
    {
        $valid = new Validation();
        $res = $valid->index($input);
        error_log('validateInput($input): '.print_r($res, 1));
        if(!empty($res))
        {
            return $res;
        }else{
            return false;
        }
    
    }

}