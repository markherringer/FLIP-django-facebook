<?php

/**
 * auth actions.
 *
 * @package    flip
 * @subpackage auth
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class authActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeAuthorize(sfWebRequest $request)
  {
    if (!$request->isMethod("post"))
    {
      return sfView::NONE;
    }
    
    $userID = $request->getParameter("fb_sig_user");
    $lastProfileUpdatedAt = $request->getParameter("fb_sig_profile_update_time");
    $sessionKey = $request->getParameter("fb_sig_session_key");
    $expirationTime = $request->getParameter("fb_sig_expires");
    
    $fbUser = new FlipFacebookUser();
    $fbUser->uid = $userID;
    $fbUser->last_profile_update_at = $lastProfileUpdatedAt;
    $fbUser->session_key = $sessionKey;
    $fbUser->expiration_time = $expirationTime;
    $fbUser->save();
  }
  
  /**
   * Removes a user's entry from the FB user table.
   *
   * @param sfWebRequest $request
   */
  public function executeRemove(sfWebRequest $request)
  {
    if (!$request->isMethod("post"))
    {
      return sfView::NONE;
    }

    $userID = $request->getParameter("fb_sig_user");
    $fbUser = Doctrine::getTable("FlipFacebookUser")->findOneByUid($userID);
    $fbUser->delete();
  }
}
