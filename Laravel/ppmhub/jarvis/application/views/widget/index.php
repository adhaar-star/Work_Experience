function setCookie(c_name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var c_value = escape(value) +
    ((exdays == null) ? "" : ("; expires=" + exdate.toUTCString()));
    document.cookie = c_name + "=" + c_value;
}

function getCookie(c_name) {
    var i, x, y, ARRcookies = document.cookie.split(";");
    for (i = 0; i < ARRcookies.length; i++) {
        x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
        y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
        x = x.replace(/^\s+|\s+$/g, "");
        if (x == c_name) {
            return unescape(y);
        }
    }
}

// define the document domain , must be the same line found
// in the iframe header for security reasons
document.domain = '<?php echo $_SERVER['HTTP_HOST'] ;?>';
//console.log('widget: '+document.domain);
// iframe configuration
var iframe, innerDoc, HEADER_HEIGHT;
iframe = document.createElement('iframe');
HEADER_HEIGHT = 45;

iframe.id = 'chat-box';
iframe.src = '<?php echo base_url() ?>jarvis';
iframe.frameBorder = 0;
iframe.outline = 'none';
iframe.style.background = 'transparent';
iframe.style.outline = 'none';
iframe.style.position = 'fixed';
iframe.style.zIndex = 999999;
iframe.style.overflow = 'hidden';
iframe.scrolling = 'no';

iframe.style.<?php echo option_get('chat-alignment') ?> = '50px';
iframe.style.width = '340px';
iframe.style.height = '400px';
iframe.style.margin = 0;
iframe.style.padding = 0;
iframe.style.display = 'block';
iframe.style.borderRadius = '4px 4px 0px 0px';
iframe.style.mozBorderRadius = '4px 4px 0px 0px';
iframe.style.webkitBorderRadius = '4px 4px 0px 0px';

if (!getCookie("collapsed")) {
    iframe.collapsed = 'true';
    setCookie("collapsed",'true');
} else {
    iframe.collapsed = 'false';
}

iframe.display = <?php echo option_get('chat-visible') ?>;

if (iframe.display) {
    window.onload = function () {
    document.body.appendChild(iframe);
    }
}

iframe.onload = function () {
    innerDoc = iframe.contentDocument || iframe.contentWindow.document;
    iframe.style.borderLeft = "1px solid #F7F5F5";
    iframe.style.borderRight = "1px solid #F7F5F5";
    innerDoc.getElementById('chat-header').addEventListener("click", toggle_chat);
    if(getCookie('collapsed') == 'true'){ // LOAD THE LAST CHAT STATE
    iframe.style.bottom = -(390 - HEADER_HEIGHT) + 'px';
    iframe.collapsed = 'true';
        innerDoc.getElementById('chat-arrow').className = 'uk-icon-toggle-off uk-icon-medium';
    }else{
      iframe.style.bottom = 0;
    }
};

// toggle chat to hide or display
function toggle_chat() {
if (iframe.collapsed == 'false') { // hide
iframe.style.bottom = -(390 - HEADER_HEIGHT) + 'px';
setCookie("collapsed", 'true');
iframe.collapsed = 'true';
innerDoc.getElementById('chat-arrow').className = 'uk-icon-toggle-off uk-icon-medium';

} else {   // display
iframe.style.bottom = 0;
iframe.collapsed = 'false';
innerDoc.getElementById('chat-arrow').className = 'uk-icon-toggle-on uk-icon-medium';
setCookie("collapsed", 'false');

}
}
