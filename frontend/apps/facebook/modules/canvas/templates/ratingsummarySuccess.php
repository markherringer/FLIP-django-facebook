<div id="module_wrapper">
    <div id="module">
        <div class="isprite module_header">
              <fb:profile-pic uid="<?php echo $friendID; ?>"></fb:profile-pic>
              <h3><?php echo $friendName; ?></h3>
            </div><!-- END #module_header -->
    
      <form id="frmQuestions" name="frmQuestions" method="post" action="<?php echo url_for("@canvas_saveratings"); ?>">
      
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
            <a class="isprite send_friend_btn" href="#" id="submit"></a>
          </div>
          
                  
        </div>
        
        </div>
      </div> 

      </form>
      
 </div><!-- #module -->
</div><!-- #module-wrapper -->

<script src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php" type="text/javascript"></script>
<script type="text/javascript">
    FB_RequireFeatures(["XFBML"], function(){
        FB.Facebook.init('<?php echo $apiKey ?>', '/canvas/xd_receiver.htm', null);
        document.getElementById('submit').onclick = function () {
            <?php $raw_props = $sf_data->getRaw('properties'); ?>
            var attachment = {
                'name': '<?php echo $userName ?> thinks <?php echo $friendName ?> is <?php echo current($raw_props) ?> at <?php echo key($raw_props) ?>',
                'href': 'http://apps.facebook.com/flip-app',
                'description': 'Visit FLIP to find out what else your friends think you\'re good at and start finding out about jobs and other opportunities.',
                'media': [
                    { 'type': 'image',
                      'src' : 'http://flip.rmssvr.net<?php echo image_path('logo.jpg') ?>',
                      'href':'http://apps.facebook.com/flip-app' }
                      ]};
            var action_links = [{'text':'Visit FLIP', 'href':'http://apps.facebook.com/flip-app'}];
            FB.Connect.streamPublish(null, attachment, action_links, <?php echo $friendID ?>, "Tell your friend why you're sending this", redirCallback);
        }

        function redirCallback()
        {
          document.getElementById("frmQuestions").submit();
        }
    });
</script>
