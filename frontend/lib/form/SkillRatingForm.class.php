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
    $this->widgetSchema->setOption("name_format", "rating[%s]");
    
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
    
    // Add the ID of the skill we're rating in
    $this->widgetSchema["skillid"] = new sfWidgetFormInputHidden();
    $this->validatorSchema["skillid"] = new sfValidatorInteger();
    
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
    $skill = Doctrine::getTable("Skill")->findOneById($values["skillid"]);
    if (!$skill)
    {
      $error = new sfValidatorError($validator, "Skill ID is invalid");
      throw new sfValidatorErrorSchema($validator, array("skillid" => $error));
    }
    
    return $values;
  }
      
  /**
   * Overriding the bind method so we always use the correct position.
   * 
   * @see frontend/lib/vendor/symfony/lib/form/sfForm#bind($taintedValues, $taintedFiles)
   */
  public function bind(array $taintedValues = null, array $taintedFiles = null)
  {
    $taintedValues["skillid"] = $this->getOption("skills")->offsetGet($this->getOption("position"))->id;
    
    parent::bind($taintedValues, $taintedFiles);
  }
}