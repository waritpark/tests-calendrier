<?php

namespace Calendrier;

include '../../App/Validator.class.php';

use App\Validator;

class ValidatorInscription extends Validator {


    /**
     * @param array $data
     * @return array!bool
     */
    public function validates(array $data) {
        parent::validates($data);
        $this->validate('mail', 'formatMail');
        $this->validate('mail', 'minLength', 9);
        $this->validate('mail', 'maxLength', 255);
        $this->validate('nom', 'minLength', 2);
        $this->validate('nom', 'maxLength', 255);
        $this->validate('prenom', 'minLength', 2);
        $this->validate('prenom', 'maxLength', 255);
        $this->validate('password', 'egalMdp', $_POST["password2"]);
        $this->validate('password', 'minLength', 8);
        $this->validate('password', 'maxLength', 100);
        $this->mdpHash('password');
        return $this->errors;
    }
}