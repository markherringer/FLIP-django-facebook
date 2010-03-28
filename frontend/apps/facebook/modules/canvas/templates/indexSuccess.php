	<div class="wrapper">
    
		<div class="header">
			<a href="#" class="logo" title="FLIP"></a>
			<ul class="nav">
				<li><a href="#" class="myflip">My Flip</a></li>
				<li><a href="#" class="profile">Profile</a></li>
				<li><a href="#" class="friends">Friends</a></li>
				<li><a href="#" class="jobs">Jobs</a></li>
				<li><a href="#" class="settings">Settings</a></li>
			</ul>
		</div><!-- END .header -->
        
		<div class="content">
        
        	<div id="top">
                <h1 class="cufon"><?php echo $userName ?></h1>
                <a href="#" class="publishBtn">Publish to Flip</a>
                
                <div class="clear"></div>
            </div><!-- END #top -->
            
			<div class="leftCol">
				<div class="photo">
          <fb:profile-pic uid="<?php echo $userID; ?>" size="normal" width="178" height="208"></fb:profile-pic>
				</div>
				<a href="#" class="blueCta"><span>Primary quick link</span></a>
				<a href="#" class="greyCta"><span>Quick link two</span></a>
				<a href="#" class="greyCta"><span>Quick link three</span></a>
			</div><!-- END .leftCol -->
            
			<div class="midCol">
				<h2 class="ratingsTitle">How your friends rate your skills</h2>
				<ul class="ratingsList">
<?php foreach ($ratings as $rating): ?>
					<li>
						<a href="#" class="ratingStar selected"></a>
						<h4><?php echo $rating->rating ?> at <?php echo $rating->Skill->name ?></h4>
						<div>
							<em class="innerLeft">by <a href="#">John</a> and <a href="#">8 others</a></em>
							<a href="#" class="innerRight">Hide this rating</a>
						</div>
					</li>
<?php endforeach ?>
				</ul>
                
                <a class="rounded_corners skills_btn" href="<?php echo url_for('@canvas_rateafriend') ?>">Call to action btn</a>
			</div><!-- END .midCol -->
            
			<div class="rightCol">
                <h2 class="jobTitle">Your chosen skills</h2>
				<ul class="jobsList">
					<li>
						<p class="chosen_intro">To start your profile, drag skills from what your friends have said into here.</p>
					</li>
                </ul>
			</div><!-- END .rightCol -->

		</div><!-- END .content -->
	</div><!-- END .wrapper -->
       
</body></html>
