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
class HeaderNode extends SimpleNode {
  
  /**
  * Compiles the node to PHP.
  *
  * @param Twig_Compiler A Twig_Compiler instance
  */
  public function compileWidget(Twig_Compiler $compiler){            
    $compiler->addDebugInfo($this);
    $this->compileExtension($compiler);
    //if($this->getNode('values')->getNode('value') instanceof \Twig_Node_Expression_GetAttr ){
    if ($this->isIterable()) {
      $this->compileIteratorInitSintax($compiler);
        $this->compileInitWidget($compiler);
        $this->compileHtmlProperties($compiler);
        $this->buildId();
        $this->compileWidgetContents($compiler);
      $this->compileIteratorEndSintax($compiler, $this->isValidateEmpty());
    }else{
      $this->compileInitWidget($compiler);
      $this->compileHtmlProperties($compiler);
      $this->compileWidgetContents($compiler);
    }    
  }
  
  public function compileEndWidget(Twig_Compiler $compiler){
    $compiler->write(sprintf('echo %s->endWidget("%s");',$this->getVarName(),$this->getTagName()));
    $compiler->raw("\n");
  }
  
  public function compileHtmlProperties(Twig_Compiler $compiler, $args = array()){
    $this->compileStandardHtmlProperties($compiler);
    $compiler->write(sprintf(',"%s"',$this->getTagName()));
    
    if($this->getNode('values')->hasNode('label')){
       $compiler->write(',');
       $compiler->subcompile($this->getNode('values')->getNode('label'));
    }
    
    $compiler->write(');');
    $compiler->raw("\n");
  }
  
  public function getWidgetName(){
    return 'html';
  }
  
  public function getTagName(){
    return 'h3';
  }
  
  public function getSuffixId(){
    return $this->getTagName();
  }  
  
  public function isIterableNode(){
    return true;
  }
}