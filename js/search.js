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

function delete_book(isbn, row) {
    if (confirm('Are you sure you want to delete this book?')) {
        const bookdelete = new FormData();
        bookdelete.set('csrf_token', csrf);
        bookdelete.set('book', isbn);
        deleteItem('librarians/delete_book', bookdelete, row, 'Book');
    }
}

function delete_movie(title, row) {
    if (confirm('Are you sure you want to delete this movie?')) {
        const moviedelete = new FormData();
        moviedelete.set('csrf_token', csrf);
        moviedelete.set('movie', title);
        deleteItem('librarians/delete_movie', moviedelete, row, 'Movie');
    }
}
function delete_article(title, row) {
    if (confirm('Are you sure you want to delete this article?')) {
        const articledelete = new FormData();
        articledelete.set('csrf_token', csrf);
        articledelete.set('article', title);
        deleteItem('librarians/delete_article', articledelete, row, 'Article');
    }
}



function checkedOut(type) {
    M.toast({
        html: `This ${type} has already been checked out`
    });
}

function deleteItem(route, form, row, type) {
    let request = new XMLHttpRequest();
    request.open('POST', url + route, true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            const data = JSON.parse(request.responseText);
            csrf = data.csrf_token;
            document.getElementById('csrf').value = csrf;
            if (data.valid) {
                row.style.display = 'none';
                M.toast({
                    html: type + ' has been successfully deleted!'
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