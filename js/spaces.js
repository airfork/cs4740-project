'use strict';
let csrf = getCookie('csrf_cookie');
const url = document.getElementById('url').value;

function reserve(space_id){
    if(confirm('Are you sure you want to reserve this study space?')){
        const studyspaceReserve = new FormData();
        studyspaceReserve.set('csrf_token', csrf);
        studyspaceReserve.set('space_id', space_id);
        reserveSpace('spaces/reserve', studyspaceReserve);
    }
}

function addChosenItem(item_id, space_id){
    if(confirm('Are you sure you want to add this item')){
        const studyspaceAddItem = new FormData();
        studyspaceAddItem.set('csrf_token', csrf);
        studyspaceAddItem.set('item_id', item_id);
        studyspaceAddItem.set('space_id', space_id);
        addItem('spaces/add_inventory', studyspaceAddItem);
    }
}

function deleteChosenItem(item_id, space_id){
    if(confirm('Are you sure you want to delete this item from the chosen study space?')){
        const studyspaceDeleteItem = new FormData();
        studyspaceDeleteItem.set('csrf_token', csrf);
        studyspaceDeleteItem.set('item_id', item_id);
        studyspaceDeleteItem.set('space_id', space_id);
        deleteItem('spaces/remove_inventory', studyspaceDeleteItem);
    }
}

function deleteItem(route, form) {
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
                    html: 'Item has been deleted from the study space!'
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

function addItem(route, form) {
    let request = new XMLHttpRequest();
    request.open('POST', url + route, true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
            const data = JSON.parse(request.responseText);
            csrf = data.csrf_token;
            document.getElementById('csrf').value = csrf;
            if (data.valid) {
                M.toast({
                    html: 'Item has been added to the study space!'
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
    request.open('POST', url + route, true);
    request.onload = function () {
        if (request.status >= 200 && request.status < 400) {
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