<p>You are rating: <?php echo $friendName;?>.</p>

<fb:profile-pic uid="<?php echo $friendID; ?>"></fb:profile-pic>

<?php include_partial("flashes"); ?>

<p>Below is a summary of all the ratings you have provided.  If you're happy with these, please click "Finish".</p>

<?php foreach ($skills as $skill): ?>
  <div>
    <strong><?php echo $skill->name;?></strong><br />
    Your rating: <?php echo $ratings[$skill->id]; ?>
  </div>
<?php endforeach; ?>

<button id='submit'>Finish</button>

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
            FB.Connect.streamPublish(null, attachment, action_links, <?php echo $friendID ?>);
        }
    });
</script>
