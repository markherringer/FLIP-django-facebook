<?php

/**
 * canvas actions.
 *
 * @package    flip
 * @subpackage canvas
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class canvasActions extends sfActions
{
  public function preExecute()
  {
    $this->setLayout("fbmlLayout");
  }
  
 /**
  * Executes canvas index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->checkLogin();

    // We have 2 calls to action on the home page by default
    // these are displayed in the view
  }

  /**
   * Kevin's test method
   * 
   * @param sfWebRequest $request
   */
  public function executeTest(sfWebRequest $request)
  {
  }
  
  /**
   * The 'Rate a friend' initial landing page.  Shows the user's friends
   * in a nice friend picker stylee.
   * 
   * @param sfWebRequest $request
   */
  public function executeRateafriend(sfWebRequest $request)
  {
    $this->checkLogin();
  }
  
  /**
   * xd_receiver.html file that Facebook needs to get XFBML linkups goin
   * 
   * @param sfWebRequest $request
   */
  public function executeXdreceiver(sfWebRequest $request)
  {
    $this->setLayout(false);
  }

  /**
   * Performs Facebook authentication check
   */
  protected function checkLogin()
  {
    // We need to make sure the user has added the application
    // otherwise we can't do anything
    $appapikey = sfConfig::get("app_facebook_apiKey");
    $appsecret = sfConfig::get("app_facebook_appSecret");
    $facebook = new Facebook($appapikey, $appsecret);
    $this->userId = $facebook->require_login();
  }
}
