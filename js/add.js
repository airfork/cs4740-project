'use strict';
M.AutoInit();
let csrf = getCookie('csrf_cookie');
const url = document.getElementById('url').value;

function addBook() {
    const book = new FormData();
    book.set('csrf_token', csrf);
    book.set('type', 'book');
    book.set('title', document.getElementById('title').value);
    book.set('author', document.getElementById('author').value);
    book.set('ISBN', document.getElementById('isbn').value);
    insert(book, 'book');
}

function addMovie() {
    const movie = new FormData();
    movie.set('csrf_token', csrf);
    movie.set('type', 'movie');
    movie.set('title', document.getElementById('m_title').value);
    movie.set('director', document.getElementById('director').value);
    movie.set('releaseDate', document.getElementById('releaseDate').value);
    movie.set('length', document.getElementById('length').value);
    insert(movie, 'movie');
}

function addArticle() {
    const article = new FormData();
    article.set('csrf_token', csrf);
    article.set('type', 'movie');
    article.set('title', document.getElementById('a_title').value);
    article.set('ajauthor', document.getElementById('ajauthor').value);
    article.set('pubdate', document.getElementById('pubdate').value);
    insert(article, 'article');
}

function insert(form, type) {
    let request = new XMLHttpRequest();
    request.open('POST', url + 'librarians/insert', true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            console.log(request.responseText);
            const data = JSON.parse(request.responseText);
            csrf = data.csrf_token;
            if (data.valid) {
                clearInputs();
                M.toast({
                    html: `A new ${type} has been successfully added`
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

function clearInputs() {
    // Clear out text inputs
    const inputList = document.querySelectorAll('.input');
    for (var i = 0; i < inputList.length; i++) {
        inputList[i].value = "";
    }

    // Remove active class from labels
    const labelList = document.querySelectorAll('label');
    for (var i = 0; i < labelList.length; i++) {
        labelList[i].classList.remove('active');
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