<!DOCTYPE html>

<?php  require 'views/header.php'; ?>

 
<!--
<br/>

<h1>Vremenska napoved</h1>

<br/><br/>


<div id="vreme-widget" style="float:left; width: 100%;">
   <div style="float:left !important; width: 100% !important; font-family: Trebuchet MS !important" id="vreme-widget-inner"></div>
   <div style="float:left !important; width: 100% !important;"><a target="_blank" href="http://www.1a-vreme.si/mesto/vreme-ljubljana/2188/" title="1A Vreme" style="font-size: 11px !important; font-family: Trebuchet MS !important; color: #ABABAB !important; float: right !important; margin: 7px 0 0 0 !important;">Vreme Ljubljana</a></div>
</div>
<script type="text/javascript" charset="utf-8">
(function() {
function asyncLoad(){
   var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;
   s.src = 'http://www.1a-vreme.si/distribute/?id=2188&noOfDays=3colorDay=487390&colorSig=ABABAB&colorTemp=7B7B7B&font=1&languageWidget=1';
   var x = document.getElementsByTagName('script')[0];
   x.parentNode.insertBefore(s, x);
}

if (window.attachEvent)
   window.attachEvent('onload', asyncLoad);
else
   window.addEventListener('load', asyncLoad, false);
})();
</script>
-->


<?php //echo '<iframe id="imdb" src="'.'http://meteo.arso.gov.si/met/sl/weather/fproduct/graphic/general/" scrolling="no"
      //    frameborder="0" height="700" width="100%" ;></iframe>'; ?>

	  
<body>
        <h1>Vremenska napoved</h1>
        
       <h2>Danes: <?php echo date('d.m.y') ?> </h2>
       
       
       <img src="http://meteo.arso.gov.si/uploads/probase/www/fproduct/graphic/sl/fcast_si-subregion_d1h15.png">
        
    </body>
	  

<?php require 'views/footer.php' ; ?>

    
