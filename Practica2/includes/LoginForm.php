<?php 
namespace es\ucm\fdi\aw; 

use es\ucm\fdi\aw\DAO\UserDAO; 

class LoginForm extends Form 
{ 
  public function __construct() 
  { 
    parent::__construct('loginForm'); 
  }

  protected function generateFormFields($data,  $errorList = array()) 
  { 
    $mail = $data['mail'] ?? ''; 

    $htmlErrorList = self::generateGlobalErrorList($errorList); 
    $mailError = self::createErrorMessage($errorList, 'mail'); 
    $passError = self::createErrorMessage($errorList, 'password'); 

    $html = <<<EOF

    EOF; 
  } 

  protected function process($data) 
  { 
    $result = array(); 

    $mail = $data['mail'] ?? null; 

    $usaer = new UserDAO(); 
  } 
} 
?>