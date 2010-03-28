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
    
    if ($request->isMethod("post"))
    {
      // ID?
      if (!$request->getParameter("friend_selector_id", false))
      {
        // error, no user ID supplied
        $this->redirect("@default?module=canvas&action=index");
      }
      
      // set into the session
      $this->getUser()->setAttribute("ratingPosition", 0);
      $this->getUser()->setAttribute("friendRatings", array());
      $this->getUser()->setAttribute("selectedFriend", $request->getParameter("friend_selector_id"));
      $this->redirect("@canvas_dorate");
    }
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
   * Stage 1 of the rating process.
   * 
   * @param sfWebRequest $request
   */
  public function executeDorate(sfWebRequest $request)
  {
    $this->checkLogin();
    
    // user ID?
    if (!$this->getUser()->getAttribute("selectedFriend", false))
    {
      $this->redirect("@canvas_rateafriend");
    }
    
    // Get friend's details
    $this->friendID = $this->getUser()->getAttribute("selectedFriend");
    $this->getResponse()->setSlot("friendID", $this->friendID);
    $friend = $this->facebook->api_client->users_getInfo($this->friendID, 'first_name, last_name');
    $this->friendName = $friend[0]["first_name"] . " " . $friend[0]["last_name"];
    
    // Get all the skills we're going to be rating the friend on
    $this->skills = Doctrine::getTable("Skill")->findAll();
    $skillNames = array();
    foreach ($this->skills as $skill)
    {
      $skillNames[$skill->id] = $skill->name;
    }
    $this->skillNames = $skillNames;
    
    // Where are we at in the process?
    $this->ratePosition = 0;
    
    // Set up defaults
    $defaults = array();
    $existingRatings = $this->getUser()->getAttribute("friendRatings", array());
    if (!empty($existingRatings))
    {
      // construct our default array nicely
      foreach ($this->skills as $skill)
      {
        if (array_key_exists($skill->id, $existingRatings))
        {
          $defaults[$skill->name] = array("rating" => $existingRatings[$skill->id]);
        }
      }
    }
    
    // Create our form
    $this->form = new SkillRatingParentForm($defaults, array("position" => $this->ratePosition, "skills" => $this->skills));
    
    // Name into a slot for the layout
    $this->getResponse()->setSlot("fbUsername", $this->friendName);
    
    // handle post
    if ($request->isMethod("post"))
    {
      $this->processRatingForm($request);
    }
  }
  
  /**
   * Processes the form data
   * 
   * @param sfWebRequest $request
   */
  protected function processRatingForm(sfWebRequest $request)
  {
    // massage the input values
    $values = array();
    $passedValues = $request->getParameterHolder()->getAll();
    $nameFormat = str_replace("%s", "(\d+)", $this->form->getName());
    foreach ($passedValues as $key => $val)
    {
      if (preg_match("/$nameFormat/", $key, $matches))
      {
        // this is one of ours
        $id = $matches[1];
        $values[$id] = $val;
      }
    }

    $this->form->bind($values);
    if ($this->form->isValid())
    {
      // cool, rating is OK
      // save the rating details into the session
      $ratings = $this->getUser()->getAttribute("friendRatings", array());
      
      // get values from form into an array
      foreach ($this->form->getEmbeddedForms() as $eForm)
      {
        $pos = $eForm->getOption("position");
        $ratings[$this->skills->offsetGet($pos)->id] = $eForm->getValue("rating");
      }
      
      $this->getUser()->setAttribute("friendRatings", $ratings);
      
      // and redirect back to the summary page, prior to saving
      $this->redirect("@canvas_summary");
    }
    else
    {
      // form validation errors
      $this->getUser()->setFlash("error", "There were some problems with your rating.  Please check and try again", false);
    }
  }
  
  /**
   * Shows a summary of the ratings
   * 
   * @param sfWebRequest $request
   */
  public function executeRatingsummary(sfWebRequest $request)
  {
    $this->checkLogin();
    
    $this->ratings = $this->getUser()->getAttribute("friendRatings", false);
    if (!$this->ratings || empty($this->ratings))
    {
      $this->redirect("@canvas_rateafriend");
    }

    // user ID?
    if (!$this->getUser()->getAttribute("selectedFriend", false))
    {
      $this->redirect("@canvas_rateafriend");
    }
    
    // Get user's details
    $user = $this->facebook->api_client->users_getInfo($this->facebook->user, 'first_name, last_name');
    $this->userName = $user[0]["first_name"] . " " . $user[0]["last_name"];

    // Get friend's details
    $this->friendID = $this->getUser()->getAttribute("selectedFriend");
    $friend = $this->facebook->api_client->users_getInfo($this->friendID, 'first_name, last_name');
    $this->friendName = $friend[0]["first_name"] . " " . $friend[0]["last_name"];
    
    // Get all the skills we've rated the friend on
    $this->skills = Doctrine::getTable("Skill")->findAll();

    $properties = array();
    foreach ($this->skills as $skill)
    {
      $rating = $this->ratings[$skill->id];
      if (substr($rating, 0, 3) != 'Not')
      {
        $properties[$skill->name] = $rating;
      }
    }
    $this->properties = $properties;

    $this->apiKey = sfConfig::get('app_facebook_apiKey');
  }
  
  /**
   * Called after the user has (hopefully) posted something to their friend's wall,
   * and saves the ratings.  This should be the result of a post.
   * 
   * @param sfWebRequest $request
   */
  public function executeSaveratings(sfWebRequest $request)
  {
    $this->checkLogin();
    
    $this->ratings = $this->getUser()->getAttribute("friendRatings", false);
    if (!$this->ratings || empty($this->ratings))
    {
      $this->redirect("@canvas_rateafriend");
    }

    // user ID?
    if (!$this->getUser()->getAttribute("selectedFriend", false))
    {
      $this->redirect("@canvas_rateafriend");
    }
    
    if (!$request->isMethod("post"))
    {
      $this->redirect("@canvas_rateafriend");
    }
    
    // Cool, everything is hunky-dory
    $this->saveRatings();
    
    // and send the user back to a confirmation page
    $this->getUser()->setAttribute("confirmratings", true);
    $this->redirect("@canvas");
  }

  /**
   * The final success page, shown once the user has completed all the ratings.
   * 
   * @param sfWebRequest $request
   */
  public function executeRatingsuccess(sfWebRequest $request)
  {
    if (!$this->getUser()->getAttribute("confirmratings", false))
    {
      $this->redirect("@canvas_rateafriend");
    }
    
    // Everything's been done
    $this->friendID = $this->getUser()->getAttribute("selectedFriend");
    $friend = $this->facebook->api_client->users_getInfo($this->friendID, 'first_name, last_name');
    $this->friendName = $friend[0]["first_name"] . " " . $friend[0]["last_name"];
    
    // Clear the session
    $this->getUser()->offsetUnset("confirmratings");
    $this->getUser()->offsetUnset("selectedFriend");
    $this->getUser()->offsetUnset("friendRatings");
  }
  
  /**
   * Handles the saving of ratings against a user's ID
   * @return unknown_type
   */
  protected function saveRatings()
  {
    $friendRatings = $this->getUser()->getAttribute("friendRatings");
    $friendID = $this->getUser()->getAttribute("selectedFriend");
    
    foreach ($friendRatings as $skillID => $ratingValue)
    {
      $rating = new Rating();
      $rating->uid = $friendID;
      $rating->by_uid = $this->facebook->user;
      $rating->skill_id = $skillID;
      $rating->rating = $ratingValue;
      $rating->save();
    }
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
    $this->facebook = new Facebook($appapikey, $appsecret);
    $this->userId = $this->facebook->require_login();
  }
}
