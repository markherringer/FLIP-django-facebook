<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <?php include_http_metas() ?>
  <?php include_metas() ?>
  <?php include_title() ?>
  <link rel="shortcut icon" href="/favicon.ico" />
  <?php include_stylesheets() ?>
  <?php include_javascripts() ?>
  
<style type="text/css">
.modal { 
    background-color:#fff; 
    display:none; 
    width:680px; 
    padding:15px; 
    text-align:left; 
    border:2px solid #333; 
 
    opacity:0.8; 
    -moz-border-radius:6px; 
    -webkit-border-radius:6px; 
    -moz-box-shadow: 0 0 50px #ccc; 
    -webkit-box-shadow: 0 0 50px #ccc; 
} 
 
.modal h2 { 
    background:url(/img/global/info.png) 0 50% no-repeat; 
    margin:0px; 
    padding:10px 0 10px 10px; 
    border-bottom:1px solid #333; 
    font-size:20px; 
}

#slider-pane{
  width:680px;
  height:335px;
  overflow:hidden;
  margin-left:10px;
}
#slider{
  width:3400px;
  height:335px;
  left:0;
  position:relative;

  
}
.question-pane{
  width:680px;
  height:335px;
  float:left;
}

</style>


</head>
<body>

  
    <?php echo $sf_content; ?>
    
    </div><!-- END #module -->
</div><!-- END #module_wrapper -->

</body>
</html>