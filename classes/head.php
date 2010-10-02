<link rel="stylesheet" type="text/css" href="modules/tsstatus/tsstatus.css" />
<link rel="stylesheet" type="text/css" href="login_panel/css/slide.css" />
<?php
if (!isset($_SESSION["theme"])) {
echo '<!--[if !IE 6]><!--><link rel="stylesheet" type="text/css" href="templates/default/style.css" /><!--<![endif]-->';
} else {
echo "<!--[if !IE 6]><!--><link rel=\"stylesheet\" type=\"text/css\" href=\"templates/{$_SESSION["theme"]}/style.css\" /><!--<![endif]-->";
}?>
<script type="text/javascript" src="modules/tsstatus/tsstatus.js"></script>
<script src="classes/doaction.js" type="text/javascript"></script>
<script src="classes/serverselect.js" type="text/javascript"></script>
<SCRIPT LANGUAGE="JavaScript">
var highlightLink = function () {
        var active = null, colour = 'white', fontcolor = 'black';
        if (this.attachEvent) this.attachEvent('onunload', function () {
            active = null;
        });
        return function (element) {
            if ((active != element) && element.style) {
                if (active) {
                	active.style.backgroundColor = '';
                	active.style.color= '';
                }
                element.style.backgroundColor = colour;
                element.style.color = fontcolor;
                active = element;
            }
        };
    }();
</SCRIPT>
<script language="javascript">
var changeCssClass = function () {
      	 var cactive = null, newclass = 'utilcontainer4';
      	 if (this.attachEven) this.attachEvent('onunload', function() {
      	 	cactive = null;
      	 	));
      	 return function (objDivID) {
      	 	if ((cactive != objDivID) && document.getElementById(objDivID).className) {
      	 		if (cactive) {
      	 			document.getElementById(cactive).className = '';
      	 		}
      	 		document.getElementById(objDivID).className = newclass;
      	 		cactive = objDivID;
      	 	}
      	 }
       }
        
</script>

<SCRIPT LANGUAGE="JavaScript">
function popUp1(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,address=0,statusbar=0,menubar=0,resizable=1,border=0,width=600,height=400,left = 0,top = 0');");
}
</script>
<script language="JavaScript">
function popUp(URL) {
day = new Date();
id = day.getTime();
eval("page" + id + " = window.open(URL, '" + id + "', 'toolbar=0,scrollbars=1,location=0,address=0,statusbar=0,menubar=0,resizable=1,border=0,width=1024,height=600,left = 0,top = 0');");
}
</script>
<script type='text/javascript' src="classes/flexcroll.js"></script>