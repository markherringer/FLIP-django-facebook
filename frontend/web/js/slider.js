  $(document).ready(function(){
    
    $('.question-pane input').customInput();
    
    var intLeftImage=1, intRightImage=2, intItemWidth=680, intLastImageIndex=3;
    var galleryslidespeed;
    var slideNum = 1;
    
    $('.next').bind('click', function() {
      //alert(slideNum);
      // ensure it's completed
      if (!isCompleted(slideNum)) return false;
      
      slideLeft();
      //alert(slideNum);
      return false;
      
    });

    $('.finish_btn').bind('click', function() {
      //alert(slideNum);
      // ensure it's completed
      if (!isCompleted(slideNum)) return false;
      
      $('#frmQuestions').submit();
      //alert(slideNum);
      return false;
      
    });

   $('.question-pane input').bind('click', function() {
      if (isCompleted(slideNum)) 
      {
        $('#question'+slideNum+' .next').removeClass('disabled');
        $('#question'+slideNum+' .finish_btn').removeClass('disabled');
      }
      else 
      {
        $('#question'+slideNum+' .next').addClass('disabled');
        $('#question'+slideNum+' .finish_btn').addClass('disabled');
      }
    });
  
    function slideLeft()
    {
      //if we've slid all the way left but somehow ended up calling this function again, just ditch out
      //if (intRightImage >= intLastImageIndex)
      //  return;
        
      intLeft=parseInt($('#slider').css('left').replace(/px/,''), 10);
      
      //if the left is not a multiple of intItemWidth, we're actually sliding right now, so ditch out
      if (0 != Math.abs(intLeft) % intItemWidth)
        return;
      
      intNewLeft=intLeft-intItemWidth;
      slideNum++;
      $('#slider').animate({left: intNewLeft}, galleryslidespeed, 'linear', showProgress) ;
      
      
    }

    function isCompleted(intSlide)
    {

      if($('#question'+intSlide+' input:checked').val())
      {
        return true;
      }
      return false;
    }

    function showProgress()
    {

      $('#module_breadcrumb a').removeClass('active');
      $('#module_breadcrumb a.prog'+slideNum).addClass('active');
      
      
    }
  
  });

  
  