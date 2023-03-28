<?php 
namespace es\ucm\fdi\aw; 

abstract class Form 
{ 
  private $id; 
  private $action; 

  public function __construct($id, $options = array() ) 
  { 
    $this->id = $id; 

    $defaultOptions = array( 'action' => null ); 
    $options = array_merge($defaultOptions, $options); 

    $this->action = $options['action']; 

    if (!$this->action) 
    { 
      $this->action = htmlentities($_SERVER['PHP_SELF']); 
    } 
  } 

  public function manage() 
  { 
    if (!$this->isSent($_POST)) 
    { 
      return $this->generate(); 
    } 
    else 
    { 
      $result = $this->process($_POST); 
      if (is_array($result)) 
      { 
        return $this->generate($_POST); 
      } 
      else 
      { 
        header('Location: ' . $result); 
        exit(); 
      } 
    } 
  } 

  private function isSent(&$params) 
  { 
    return isset($params['action']) && $params['action'] && $this->id; 
  } 

  protected function process($data) 
  { 
    return array(); 
  } 

  protected function generateFormFields($data, $errorList = array()) 
  { 
    return ''; 
  } 

  private function generate(&$data = array(), &$errorList = array()) 
  { 
    $htmlFormFields = $this->generateFormFields($data, $errorList); 
    $html = <<<EOS
    <form method="POST" action="$this->action" id="$this->id" >
      <input type="hidden" name="action" value="$this->id" />
      $htmlFormFields
    </form>
    EOS;

    return $html; 
  } 

  protected static function generateGlobalErrorList($errorList = array()) 
  { 
    $html = ''; 

    $errorKeys = array_filter(array_keys($errorList), function ($elem) 
    { 
      return is_numeric($elem); 
    }); 

    $numErrors = count($errorKeys); 
    if ($numErrors > 0) 
    { 
      $html = "<ul>"; 
      if ($numErrors == 1) 
      { 
        $html .= "<li>$errorList[0]</li>"; 
      } 
      else 
      { 
        foreach ($errorKeys as $key) 
          $html .= "<li>$errorList[$key]</li>"; 

        $html .= "</li>"; 
      } 
      $html .= '</ul>'; 
    } 
    return $html; 
  } 

  protected static function createErrorMessage($errorList = array(), $id = '') 
  { 
    $html = ''; 

    if (isset($errorList[$id])) 
    { 
      $html = "<div class=\"alert alert-danger m-2 justify-content-center align-center\" role=\"alert\">{$errorList[$id]}</div>"; 
    } 
    return $html; 
  } 
} 
?>