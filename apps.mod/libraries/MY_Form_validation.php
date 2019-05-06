<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 02/02/2016
 * Time: 22:56
 */

class MY_Form_validation extends CI_Form_validation{

    /**
     * set error message
     *
     * sets the error message associated with a particular field
     *
     * @param   string  $field  Field name
     * @param   string  $error      Error message
     */
    public function setError($field, $error){
        $this->_field_data[$field]['error'] = $error;
    }

}