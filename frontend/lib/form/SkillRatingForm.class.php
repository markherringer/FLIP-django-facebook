<?php

class SkillRatingForm extends sfForm
{
  /**
   * Our form configuration method
   * 
   * @see frontend/lib/vendor/symfony/lib/form/sfForm#configure()
   */
  public function configure()
  {
    // name format
    //$this->widgetSchema->setOption("name_format", "rating[%s]");
    
    // Set up the radio icons for the 4 states
    $states = Doctrine::getTable("Rating")->getStates();
    $choices = array();
    $i = 0;
    foreach ($states as $state)
    {
      $choices[$state] = $state;
    }
    $this->widgetSchema["rating"] = new sfWidgetFormSelectRadio(array("choices" => $choices));
    $this->validatorSchema["rating"] = new sfValidatorChoice(array("choices" => $choices));
    
    // Set up additional validation
    $this->validatorSchema->setPostValidator(
      new sfValidatorCallback(array(
        'callback'  =>  array($this, 'postValidate'),
        'arguments' =>  array()
    )));
  }
  
  /**
   * Our postvalidator function. Used for gnarly validation that can't be covered
   * with the usual Symfony validators
   * 
   * @param sfValidator $validator
   * @param array $values
   * @return array
   */
  public function postValidate($validator, $values)
  {
    // Check skill ID exists
    $skillID = $this->getOption("skills")->offsetGet($this->getOption("position"))->id;
    $skill = Doctrine::getTable("Skill")->findOneById($skillID);
    if (!$skill)
    {
      $error = new sfValidatorError($validator, "Skill ID is invalid");
      throw new sfValidatorErrorSchema($validator, array("skillid" => $error));
    }
    
    return $values;
  }
}