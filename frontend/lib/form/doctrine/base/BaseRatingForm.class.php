<?php

/**
 * Rating form base class.
 *
 * @method Rating getObject() Returns the current form's model object
 *
 * @package    flip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRatingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'uid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RatedUser'), 'add_empty' => false)),
      'by_uid'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RatingUser'), 'add_empty' => false)),
      'skill_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Skill'), 'add_empty' => false)),
      'rating'     => new sfWidgetFormChoice(array('choices' => array('Not very good' => 'Not very good', 'Good' => 'Good', 'Very good' => 'Very good', 'Excellent' => 'Excellent'))),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'deleted_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'uid'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RatedUser'))),
      'by_uid'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('RatingUser'))),
      'skill_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Skill'))),
      'rating'     => new sfValidatorChoice(array('choices' => array(0 => 'Not very good', 1 => 'Good', 2 => 'Very good', 3 => 'Excellent'), 'required' => false)),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'deleted_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rating[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rating';
  }

}
