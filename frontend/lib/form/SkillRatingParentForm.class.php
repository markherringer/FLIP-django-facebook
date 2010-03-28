<?php

class SkillRatingParentForm extends sfForm
{
  public function configure()
  {
    // Schema name format
    $this->widgetSchema->setOption("name_format", "sr_parent[%s]");
    
    // Embed a form for each skill we have
    $skills = $this->getOption("skills", false);
    if (!$skills)
    {
      throw new InvalidArgumentException("Skills must be passed");
    }
    
    for ($i = 0; $i < $skills->count(); $i++)
    {
      $newForm = new SkillRatingForm($this->getDefault($skills->offsetGet($i)->name), array("skills" => $skills, "position" => $i));
      $newForm->disableCSRFProtection();
      $newForm->disableLocalCSRFProtection();
      unset($newForm["_csrf_token"]);
      $this->embedForm($skills->offsetGet($i)->name, $newForm);
    }
  }
  
  /**
   * Overriding the bind for embedded forms
   * 
   * @see lib/vendor/symfony/lib/form/sfForm#bind($taintedValues, $taintedFiles)
   */
  public function bind(array $taintedValues = array(), array $taintedFiles = array())
  {
    parent::bind($taintedValues, $taintedFiles);
    
    foreach($this->embeddedForms as $name => $form)
    {
      $form->bind($taintedValues[$name], $taintedFiles);
    }
  }
}