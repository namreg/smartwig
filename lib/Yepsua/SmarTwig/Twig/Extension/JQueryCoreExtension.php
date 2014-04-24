<?php

/*
 * This file is part of the SmarTwig (Twig Extension).
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwig\Twig\Extension;

use \YsJQuery;
use \YsArgument;

class JQueryCoreExtension extends \Twig_Extension {

  /**
   * Returns the token parser instance to add to the existing list.
   *
   * @return array An array of Twig_TokenParser instances
   */
  public function getTokenParsers() {
    return array(
        new \Yepsua\SmarTwig\Twig\TokenParser\RCTokenParser(),
        new \Yepsua\SmarTwig\Twig\TokenParser\AjaxStatusTokenParser(),
    );
  }
  
  /**
  * Returns a list of functions to add to the existing list.
  *
  * @return array An array of functions
  */
  public function getFunctions(){
    return array(
        'jQuery' => new \Twig_Function_Method($this, 'jsJquery',array('is_safe' => array('html'))),
        'arg' => new \Twig_Function_Method($this, 'argument',array('is_safe' => array('html'))),
    );
  }
  
  public function jsJquery($selector, $event = null, $sintax = null){
    $jquery = new YsJQuery($selector, $event);
    if($sintax !== null){
      $jquery->execute($sintax);
    }
    return $jquery;
  }
  
  public function argument($value){
    return new YsArgument($value);
  }
  
  /**
   * Returns the name of the extension.
   *
   * @return string The extension name
   */
  public function getName() {
    return 'jquery.core';
  }
}