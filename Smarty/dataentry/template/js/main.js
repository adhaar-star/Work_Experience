
var menuSize = new Array();

function changeMenu( menuNumber, selItem ) {
	//document.writeln("TESTING");
	
	for(var i=0; i < menuSize[menuNumber]; i++) {
		menuObject = document.getElementById('menu'+menuNumber+'_'+i);
		
		if(selItem == i) {
			menuObject.className = "activeMenuItem";	
		} else {
			menuObject.className = "menuItem";
		}
	}
}

// XAJAX Loading Function
xajax.loadingFunction = function(){
	xajax.$('loadingMessage').style.display='block';};
            
function hideLoadingMessage() {
	xajax.$('loadingMessage').style.display = 'none';
}

xajax.doneLoadingFunction = hideLoadingMessage;