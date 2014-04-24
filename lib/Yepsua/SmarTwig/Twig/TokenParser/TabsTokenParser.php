<?php

/*
 * This file is part of the SmarTwig (Twig Extension).
 *
 * (c) Omar Yepez <omar.yepez@yepsua.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Yepsua\SmarTwig\Twig\TokenParser;

use Yepsua\SmarTwig\Twig\Node\TabsNode;

class TabsTokenParser extends SectionTokenParser {
  
  public function getNodeInstance(\Twig_Token $token){
    return new TabsNode($this->getNames(), new \Twig_Node($this->getValues()), $this->getSectionsNames(), new \Twig_Node($this->getSectionsValues()), $token->getLine(), $this->getTag());
  }
  
  public function decideUISectionEnd(\Twig_Token $token) {
    return $this->decideUITabEnd($token);
  }
  
  public function decideUITabEnd(\Twig_Token $token) {
    return $token->test('end_ui_tab');
  }
  
  /**
   * Gets the tag name associated with this token parser.
   *
   * @param string The tag name
   */
  public function getTag() {
    return 'ui_tabs';
  }
  
  public function getInternalTag(){
    return 'ui_tab';
  }
}