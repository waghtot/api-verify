<?php

class Validation extends Controller
{

    public function index($input){

        foreach($input->find as $key => $value)
        {
            foreach($input->cnf as $object)
            {
                if($object->fieldName == $key)
                {
                    switch($object->contentType)
                    {
                        case 'text':
                            $input->find->$key = $this->checkIfText($value, $object->fieldType);
                        break;
                        case 'number':
                            $input->find->$key = $this->checkIfNumber($value, $object->fieldType);
                        break;
                        case 'any':
                            $input->find->$key = $this->checkIfAny($value, $object->fieldType);
                        break;
                        case 'date':
                            $input->find->$key = $this->checkIfdate($value, $object->fieldType);
                        break;
                        case 'time':
                            $input->find->$key = $this->checkIfTime($value, $object->fieldType);
                        break;
                        case 'datetime':
                            $input->find->$key = $this->checkIfDateTime($value, $object->fieldType);
                        break;
                        case 'email':
                            $input->find->$key = $this->checkIfEmail($value, $object->fieldType);
                        break;
                        case 'password':
                            $input->find->$key = $this->checkIfPassword($value, $object->fieldType);
                        break;
                    }
                }
            }
        }
        return $input->find;
    }

    public function checkIfText($string, $type)
    {
        return $this->checkWithType($string, $type);
    }

    public function checkIfNumber($string, $type)
    {
        return $this->checkWithType($string, $type);
    }

    public function checkIfAny($string, $type)
    {
        return $this->checkWithType($string, $type);
    }

    public function checkIfdate($string, $type)
    {
        return $this->checkWithType($string, $type);
    }

    public function checkIfTime($string, $type)
    {
        return $this->checkWithType($string, $type);    
    }

    public function checkIfDateTime($string, $type)
    {
        return $this->checkWithType($string, $type);   
    }

    public function checkIfEmail($string, $type)
    {

        if (filter_var($string, FILTER_VALIDATE_EMAIL))
        {
            return $this->checkWithType($string, $type);
        } else {
            return false;
        }
    }

    public function checkIFPassword($string, $type){

        if(!empty($string) && strlen($string) == 32 ){
            return $this->checkWithType($string, $type);
        }
        return false;
    }

    public function checkWithType($string, $type)
    {
        if(empty($string) && $type !== 0 ){
            return false;
        }
        return true;
    }

}