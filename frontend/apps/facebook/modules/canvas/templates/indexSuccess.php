<p>Hello, <fb:name uid="<?php echo $userId; ?>" useyou="false" />!</p>

<p>
  Friends:
  <?php foreach ($friends as $friend): ?>
    <?php echo $friend; ?><br />
  <?php endforeach;?>
</p>