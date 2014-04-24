<?php

/*
 * This file is part of the SmarTwig (Twig Extension).
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwig\Twig\Node;

use \Twig_Compiler;

/**
 * 
 */
class BlockUINode extends SimpleNode {    
    
  public function __construct($names, $values, $lineno, $tag = null) {
    parent::__construct($names, $values, $lineno, $tag);
    $this->setOnlyJsS(true);
    $this->setIsPlugin(true);
    if($this->getNode('values')->hasNode('for')){
      $this->setInSelector(true);
    }else{
      $this->setInSelector(false);
    }
  }

  public function configureCallableMethods(){
    return array(
      'for' => array('method' => 'in'),
      'label' => array('method' => '_message'),
      'delay' => array('method' => '_timeout'),
      'content' => array('method' => '_content'),
      'header' => array('method' => '_title'),
    );
  }

  public function compileBuilderFuntcionName(Twig_Compiler $compiler){
    if($this->getNode('values')->hasNode('for')){
      $compiler->raw('->blockElement("EL")');
    }else{
      $compiler->raw('->block()');
    }
  }

  public function getWidgetName(){
    return 'block';
  }

  public function getPluginName() {
    return 'blockUI';
  }
}