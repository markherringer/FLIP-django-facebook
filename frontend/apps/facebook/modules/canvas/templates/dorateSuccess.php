<p>You are rating: <?php echo $friendName;?>.</p>

<fb:profile-pic uid="<?php echo $friendID; ?>"></fb:profile-pic>

<?php include_partial("flashes"); ?>

<p>
  How would you rate <?php echo $friendName; ?> on the following skill?
  
</p>

<form method="post" action="<?php echo url_for("@canvas_dorate"); ?>">

<?php echo $form; ?>

<input type="submit" value="Save this rating" />

</form>