'use strict'

const keypressWaitMilliseconds = 500;
let timer = null;
let searchbar = null;

const onTimerExpired = () => {
    timer = null;

    let name = searchbar.value;

    if (name === '') {
        removeSearchFilter('name');
    }
    else
        applySearchFilter('name', name);
}

function onProductSearchbarContentChanged() {
    if (timer !== null)
        clearTimeout(timer);

    timer = setTimeout(onTimerExpired, keypressWaitMilliseconds);
}

window.addEventListener('load', () => {
    //  Cache searchbar
    searchbar = $('#product-searchbar')[0];
    searchbar.addEventListener('input', onProductSearchbarContentChanged);
});