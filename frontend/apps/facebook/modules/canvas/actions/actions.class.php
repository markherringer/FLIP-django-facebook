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

  public function executeTest(sfWebRequest $request)
  {
  }

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
