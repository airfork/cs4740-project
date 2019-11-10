'use strict';
M.AutoInit();
let csrf = getCookie('csrf_cookie');
const url = document.getElementById('url').value;

function checkout(isbn) {
    if (confirm('Are you sure you want to check out this book?')) {
        let request = new XMLHttpRequest();
        request.open('POST', url + 'checkout', true);
        request.onload = function () {
            if (request.status >= 200 && request.status < 400) {
                console.log(request.responseText);
                const data = JSON.parse(request.responseText);
                csrf = data.csrf_token;
                document.getElementById('csrf').value = csrf;
                if (data.valid) {
                    M.toast({
                        html: 'Item has been checked out!'
                    });
                } else {
                    M.toast({
                        html: data.issue
                    });
                }
            } else {
                // We reached our target server, but it returned an error
                M.toast({
                    html: 'There was a problem processing your request, please refresh the page and try again.'
                });
            }
        };

        request.onerror = function () {
            // There was a connection error of some sort
            console.log("There was an error of some type, please try again");
            M.toast({
                html: 'There was a problem processing your request, please refresh the page and try again.'
            });
        };

        const checkout = new FormData();
        checkout.set('csrf_token', csrf);
        checkout.set('book', isbn);
        request.send(checkout);
    }
}

function getCookie(cname) {
    const name = cname + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) === ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) === 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}