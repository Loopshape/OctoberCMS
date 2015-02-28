// Based
// Creare's 'Implied Consent' EU Cookie Law Banner
// Created by Rob Kent, Tom Foyster & James Bavington
// Amended and updated by Carlos González

function createDiv(create,privacyMessage,cookieName,cookieValue,cookieDuration){
    var bodytag = document.getElementsByTagName('body')[0];
    var div = document.createElement('div');
    div.setAttribute('id','cookie-law');
    div.innerHTML = privacyMessage;
    bodytag.appendChild(div);
    document.getElementsByTagName('body')[0].className+=' cookiebanner';
    if (create=="1") {
        createCookie(cookieName,cookieValue, cookieDuration);
    }

}

function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }else {
        var expires = "";
    }

    document.cookie = name+"="+value+expires+"; path=/";

}

function checkCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}