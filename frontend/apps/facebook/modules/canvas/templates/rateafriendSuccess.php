<div id="module_wrapper">
    <div id="module">
        <div class="isprite module_header">
              <h3>Select a friend</h3>
            </div><!-- END #module_header -->
    
      <div id="slider-pane">
        <div id="slider">

        <div class="question-pane">
          <div id="module_content">
            
            <div id="rating_summary">
              Select the friend you want to begin rating:
              
              <div id="iframe" style="width: 400px; margin: 0 auto;">
  
                <fb:serverFbml>
                
                    <!-- friend selector code -->
                    <script type="text/fbml">
                      <fb:fbml>

                        <form method="post" action="<?php echo url_for("@canvas_rateafriend", true); ?>">

                        <fb:friend-selector />

                        <input type="submit" value="Go" />
                        </form>
        
                      </fb:fbml>
                    </script>
                
                </fb:serverFbml>
                
             </div>

           </div><!-- #rating_summary -->
          </div>
          
          <div class="isprite module_footer">
          </div>
          
                  
        </div>
        
        </div>
      </div> 

 </div><!-- #module -->
</div><!-- #module-wrapper -->
