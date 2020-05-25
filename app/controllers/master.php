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
                    case 'Register':
                        $data->config = $this->configCheck($data);
                        echo json_encode($this->validateInput($data->config));
                        die;
                    break;
                    case 'Login':
                        $data->config = $this->configCheck($data);
                        echo json_encode($this->validateInput($data->config));
                        die;
                    break;
                    case 'User':
                        $res = $this->checkUser($data);
                        echo json_encode($res);
                        die;
                    break;
                    case 'Profile':
                        $data->config = $this->configCheck($data);
                        echo json_encode($this->validateInput($data->config));
                        die;
                    break;
                    case 'Person':
                        $data->config = $this->configCheck($data);
                        echo json_encode($this->validateInput($data->config));
                        die;
                    break;
                    case 'Profile':
                        $data->config = $this->configCheck($data);
                        echo json_encode($this->validateInput($data->config));
                        die;
                    break;
                }
            }
        }
    }

    private function configCheck($input)
    {
        $cnf = json_decode(ConfigurationCheck::index($input));
        if(!empty($cnf))
        {
            unset($input->action);
            unset($input->params->projectId);
            if(isset($input->params->user)){
                unset($input->params->user);
            }
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

        if(!empty($res))
        {
            return $res;
        }else{
            return false;
        }
    
    }

    private function checkUser($input)
    {

        $user = new CheckUser();
        $res = $user->index($input);

        if(!empty($res))
        {
            return $res;
        }else{
            return false;
        }
 
    }

}