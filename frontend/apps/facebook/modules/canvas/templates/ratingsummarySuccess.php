<div id="module_wrapper">
    <div id="module">
        <div class="isprite module_header">
              <fb:profile-pic uid="<?php echo $friendID; ?>"></fb:profile-pic>
              <h3><?php echo $friendName; ?></h3>
            </div><!-- END #module_header -->
    
      <form id="frmQuestions" name="frmQuestions" method="post" action="<?php echo url_for("@canvas_dorate"); ?>">
      
      <div id="slider-pane">
        <div id="slider">

        <div class="question-pane">
          <div id="module_content">
            
            <div id="rating_summary"> 
            
            <?php foreach ($skills as $skill): ?>
              <?php if (!preg_match("/^Not/", $ratings[$skill->id])): ?>
                <p>
                  <strong><?php echo ucfirst($ratings[$skill->id]); ?></strong>
                  at <?php echo strtolower($skill->name); ?>
                </p>
              <?php endif; ?>
            <?php endforeach; ?>
            
            </div>

          </div>
          
          <div class="isprite module_footer">
            <a id="edit_ratings_link" href="<?php echo url_for("@canvas_dorate", true); ?>">or edit your ratings</a>
            <a class="isprite send_friend_btn" href="#"></a>
          </div>
          
                  
        </div>
        
        </div>
      </div> 

      </form>
      
 </div><!-- #module -->
</div><!-- #module-wrapper -->