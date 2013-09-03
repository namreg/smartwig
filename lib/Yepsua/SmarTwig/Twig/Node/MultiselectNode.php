<?php

namespace Yepsua\SmarTwig\Twig\Node;

class MultiselectNode extends SimpleNode {
    
  public function getWidgetName(){
    return 'multiselect';
  }
  
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('select');
  }
}