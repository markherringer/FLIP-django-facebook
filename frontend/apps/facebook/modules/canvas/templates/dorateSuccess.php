<div id="module_wrapper">
    <div id="module">
        <div class="isprite module_header">
              <fb:profile-pic uid="<?php echo $friendID; ?>"></fb:profile-pic>
              <h3><?php echo get_slot("fbUsername"); ?></h3>
                <ul id="module_breadcrumb">
                    <li><a class="isprite prog1 one active" href="#"></a></li>
                    <li><a class="isprite prog2 two" href="#"></a></li>
                    <li><a class="isprite prog3 three" href="#"></a></li>
                    <li><a class="isprite prog4 four" href="#"></a></li>
                    <li><a class="isprite prog5 five" href="#"></a></li>
                </ul>
            </div><!-- END #module_header -->
    
      <form id="frmQuestions" name="frmQuestions" method="post" action="<?php echo url_for("@canvas_dorate"); ?>">
      
      <?php echo $form->renderHiddenFields(); ?>
            
      <div id="slider-pane">
        <div id="slider">
        
        <?php $i = 1; ?>
        <?php foreach ($form as $id => $eForm): ?>
        
          <div class="question-pane" id="question<?php echo $i; ?>">
            <div id="module_content">
            
              <h3>How good is <?php echo $friendName; ?> at <?php echo $skillNames[$id]; ?>?</h3>
              
              <div id="question_btns">
              
                <?php echo $eForm["rating"]->render(); ?>
                
                <div class="clear"></div>
                
              </div>
            
            </div>
            
            <div class="isprite module_footer">
              <a class="isprite <?php if ($i == count($form->getEmbeddedForms())): ?>finish_btn<?php else: ?>next_btn next<?php endif;?>" href="#"></a>
            </div>
        
          </div>
          
          <?php $i++; ?>
        <?php endforeach?>
        
        </div>
      </div> 
      </form>
 </div><!-- #module -->
</div><!-- #module-wrapper -->
