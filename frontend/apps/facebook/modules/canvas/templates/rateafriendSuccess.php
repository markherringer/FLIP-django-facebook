Select the friend you want to begin rating:

<fb:serverFbml>

    <!-- friend selector code -->
    <script type="text/fbml">
      <fb:fbml>

        <form method="post" action="<?php echo url_for("@canvas_dorate", true); ?>">

          <fb:friend-selector />

          <input type="submit" value="Go" />
        </form>
        
      </fb:fbml>
    </script>

</fb:serverFbml>

