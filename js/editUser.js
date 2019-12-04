'use strict';

function updateUser() {
    let name = document.getElementById('name').value;
    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    if (name.trim().length === 0) {
        M.toast({
            html: 'Name cannot be empty'
        });
        return;
    }
    if (email.trim().length === 0) {
        M.toast({
            html: 'Email cannot be empty'
        });
        return;
    }
    if (password.length < 8) {
        M.toast({
            html: 'Password must be at least 8 characters long'
        });
        return;
    }
    const updateUser = new FormData();
    updateUser.set('csrf_token', csrf);
    updateUser.set('name', name);
    updateUser.set('email', email);
    updateUser.set('password', password);
    sendRequest(updateUser);
}

function sendRequest(form) {
    let request = new XMLHttpRequest();
    request.open('POST', url, true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            const data = JSON.parse(request.responseText);
            csrf = data.csrf_token;
            if (data.valid) {
                M.toast({
                    html: 'Account has been successfully updated!'
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