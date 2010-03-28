<?php

/**
 * MySkills form base class.
 *
 * @method MySkills getObject() Returns the current form's model object
 *
 * @package    flip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMySkillsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'uid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FlipFacebookUser'), 'add_empty' => false)),
      'deleted_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'uid'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('FlipFacebookUser'))),
      'deleted_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('my_skills[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MySkills';
  }

}
