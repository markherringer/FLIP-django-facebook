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
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $appapikey = sfConfig::get("app_facebook_apiKey");
    $appsecret = sfConfig::get("app_facebook_appSecret");
    $facebook = new Facebook($appapikey, $appsecret);
    $this->userId = $facebook->require_login();
    
    $friends = $facebook->api_client->friends_get();
    $this->friends = array_slice($friends, 0, 25);
  }
}
