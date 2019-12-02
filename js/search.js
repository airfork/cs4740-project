'use strict';
M.AutoInit();
let csrf = getCookie('csrf_cookie');
const url = document.getElementById('url').value;

function bookCheckout(isbn) {
    if (confirm('Are you sure you want to check out this book?')) {
        const bookCheckout = new FormData();
        bookCheckout.set('csrf_token', csrf);
        bookCheckout.set('book', isbn);
        checkout('books/checkout', bookCheckout);
    }
}

function movieCheckout(title, director) {
    if (confirm('Are you sure you want to check out this movie?')) {
        const movieCheckout = new FormData();
        movieCheckout.set('csrf_token', csrf);
        movieCheckout.set('title', title);
        movieCheckout.set('director', director);
        checkout('movies/checkout', movieCheckout);
    }
}

function articleCheckout(title, author, pubDate) {
    if (confirm('Are you sure you want to check out this article/journal?')) {
        const articleCheckout = new FormData();
        articleCheckout.set('csrf_token', csrf);
        articleCheckout.set('title', title);
        articleCheckout.set('author', author);
        articleCheckout.set('pubDate', pubDate);
        checkout('articles/checkout', articleCheckout);
    }
}

function reserve(space_id){
    if(confirm('Are you sure you want to reserve this study space?')){
        const studyspaceReserve = new FormData();
        studyspaceReserve.set('csrf_token', csrf);
        studyspaceReserve.set('space_id', space_id);
        reserveSpace('studyspaces/reserve', studyspaceReserve);
    }
}

function checkedOut(type) {
    M.toast({
        html: `This ${type} has already been checked out`
    });
}

function alreadyReserved(){
    M.toast({
        html: `This study space has already been reserved`
    });
}

function checkout(route, form) {
    let request = new XMLHttpRequest();
    request.open('POST', url + route, true);
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

    request.send(form);
}

function reserveSpace(route, form) {
    let request = new XMLHttpRequest();
    console.log(url+route)
    request.open('POST', url + route, true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            console.log(request.responseText);
            const data = JSON.parse(request.responseText);
            csrf = data.csrf_token;
            document.getElementById('csrf').value = csrf;
            if (data.valid) {
                M.toast({
                    html: 'Study space has been reserved!'
                });
            } else {
                M.toast({
                    html: data.issue
                });
            }
        } else {
            console.log('reached');
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

    request.send(form);
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