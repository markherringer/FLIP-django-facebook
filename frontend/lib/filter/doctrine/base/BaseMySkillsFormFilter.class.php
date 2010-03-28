<?php

/**
 * MySkills filter form base class.
 *
 * @package    flip
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseMySkillsFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'uid'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('FlipFacebookUser'), 'add_empty' => true)),
      'deleted_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'uid'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('FlipFacebookUser'), 'column' => 'id')),
      'deleted_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('my_skills_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'MySkills';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'uid'        => 'ForeignKey',
      'deleted_at' => 'Date',
    );
  }
}
