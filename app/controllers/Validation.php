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

        if(preg_match('!\d+!', $string)){
            return false;
        }

        return $this->checkWithType($string, $type);

    }

    public function checkIfNumber($string, $type)
    {

        if(is_object($string)){
            foreach($string as $key => $value){
                error_log('validation: '.$key.' - '.$value);
                if(preg_match('/[a-zA-Z]+/', $value) == 1){
                    return false;
                }
                if($this->checkWithType($value, $type)!== true)
                {
                    return false;
                }
            }
        }else{
            if(preg_match('/[a-zA-Z]+/', $string) == 1){
                return false;
            }
            if($this->checkWithType($string, $type)!== true)
            {
                return false;
            }
        }
        return true;

    }

    public function checkIfAny($string, $type)
    {
        return $this->checkWithType($string, $type);
    }

    public function checkIfdate($string, $type)
    {
        if(strlen($string)==10 && $this->ifDate($string)!==false){
            return $this->checkWithType($string, $type);            
        }
        return false;
    }

    public function checkIfTime($string, $type)
    {
        if(strlen($string)==5 && $this->ifTime($string)!==false)
        {
            return $this->checkWithType($string, $type);    
        }
        return false;
    }

    public function checkIfDateTime($string, $type)
    {
        if(strlen($string)==16 && $this->ifDateTime($string)!==false)
        {
            return $this->checkWithType($string, $type);    
        }
        return false;   
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

        if(strlen(trim($string))==0 && $type !== 3 ){
            return false;
        }
        return true;
    }

    public function ifDate($input)
    {
        return checkdate(substr($input, 3, 2), substr($input, 0, 2),  substr($input, 6, 4));
    }

    public function ifTime($input)
    {

        if(strtotime($input)!==false){
            return true;
        }
 
        return false;

    }

    public function ifDateTime($input)
    {
        $test = explode(' ', $input);
        if(count($test) !== 2)
        {
            return false;
        }

        if($this->ifDate($test[0])==false){
            return false;
        }        

        if(strtotime($test[1])==false){
            return false;
        }
        
        return true;
    }

}