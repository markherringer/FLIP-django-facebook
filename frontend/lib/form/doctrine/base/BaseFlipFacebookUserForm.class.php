<?php

/**
 * FlipFacebookUser form base class.
 *
 * @method FlipFacebookUser getObject() Returns the current form's model object
 *
 * @package    flip
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseFlipFacebookUserForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'uid'                    => new sfWidgetFormInputText(),
      'last_profile_update_at' => new sfWidgetFormDateTime(),
      'session_key'            => new sfWidgetFormTextarea(),
      'expiration_time'        => new sfWidgetFormDateTime(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'deleted_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'uid'                    => new sfValidatorInteger(),
      'last_profile_update_at' => new sfValidatorDateTime(array('required' => false)),
      'session_key'            => new sfValidatorString(),
      'expiration_time'        => new sfValidatorDateTime(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
      'deleted_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('flip_facebook_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'FlipFacebookUser';
  }

}
