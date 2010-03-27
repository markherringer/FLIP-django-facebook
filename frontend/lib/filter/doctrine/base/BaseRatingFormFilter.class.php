<?php

/**
 * Rating filter form base class.
 *
 * @package    flip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseRatingFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RatedUser'), 'add_empty' => true)),
      'by_uid'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('RatingUser'), 'add_empty' => true)),
      'skill_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Skill'), 'add_empty' => true)),
      'rating'     => new sfWidgetFormChoice(array('choices' => array('' => '', 'Not very good' => 'Not very good', 'Good' => 'Good', 'Very good' => 'Very good', 'Excellent' => 'Excellent'))),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'uid'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RatedUser'), 'column' => 'id')),
      'by_uid'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('RatingUser'), 'column' => 'id')),
      'skill_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Skill'), 'column' => 'id')),
      'rating'     => new sfValidatorChoice(array('required' => false, 'choices' => array('Not very good' => 'Not very good', 'Good' => 'Good', 'Very good' => 'Very good', 'Excellent' => 'Excellent'))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('rating_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rating';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'uid'        => 'ForeignKey',
      'by_uid'     => 'ForeignKey',
      'skill_id'   => 'ForeignKey',
      'rating'     => 'Enum',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'deleted_at' => 'Date',
    );
  }
}
