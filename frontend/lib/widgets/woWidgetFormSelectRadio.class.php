<?php

class woWidgetFormSelectRadio extends sfWidgetFormSelectRadio
{
  public function formatter($widget, $inputs)
  {
    $rows = array();
    
    $classes = array(
      "not_good",
      "good",
      "great",
      "excellent"
    );
    
    foreach ($inputs as $input)
    {
      $content  = $input["label"];
      $content .= $input["input"];
      
      $rows[] = $this->renderContentTag("li", $content, array("class" => "bigradio " . array_shift($classes)));
    }
    
    return !$rows ? '' : $this->renderContentTag("ul", implode($this->getOption("separator"), $rows), array("class" => $this->getOption("class")));
  }
}