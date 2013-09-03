<?php

namespace Yepsua\SmarTwig\Twig\Node;

/**
 * 
 */
class VideoNode extends SimpleNode {    
    
  public function getWidgetName(){
    return 'video';
  }
    
  public function configureHTMLProperties(){
    return $this->getHTMLAttrs('video');
  }
}