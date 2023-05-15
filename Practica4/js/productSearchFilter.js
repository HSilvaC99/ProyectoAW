'use strict'

const searchFilters = {};

const onProductReadSuccess = (result) => {
    resetProductsView();
    
    result.forEach((element) => {
        addProductToView(element);
    });
};
const onProductReadError = (error) => {
    console.log(`Read failed: ${JSON.stringify(error.responseText)}`);
};

const refreshProductsViewAsync = () => {
    //  Prepare data
    const data = {
        action: 'read_product',
        filters: searchFilters
    };

    //  Do GET
    $.ajax({
        url: 'includes/requestHandler.php',
        data: data,
        type: 'GET',
        success: onProductReadSuccess,
        error: onProductReadError,
        dataType: 'json'
    });
};

function applySearchFilter(filterName, filterValue) {
    searchFilters[filterName] = filterValue;

    refreshProductsViewAsync();
}
function removeSearchFilter(filterName) {
    delete searchFilters[filterName];

    refreshProductsViewAsync();
}

window.addEventListener('load', (event) => {
    refreshProductsViewAsync();
});