<?php

/**
 * BaseSkill
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Rating
 * 
 * @method string              getName()   Returns the current record's "name" value
 * @method Doctrine_Collection getRating() Returns the current record's "Rating" collection
 * @method Skill               setName()   Sets the current record's "name" value
 * @method Skill               setRating() Sets the current record's "Rating" collection
 * 
 * @package    flip
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSkill extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('skill');
        $this->hasColumn('name', 'string', null, array(
             'type' => 'string',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Rating', array(
             'local' => 'id',
             'foreign' => 'skill_id'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $this->actAs($softdelete0);
    }
}