'use strict'

const searchFilters = {};

const refreshProductsViewAsync = async () => {
    try {
        //  Prepare data
        const data = {
            action: 'read_product',
            filters: searchFilters
        };

        console.log(data);

        //  Do GET
        const result = await $.ajax({
            url: 'includes/requestHandler.php',
            data: data,
            type: 'GET',
            dataType: 'json'
        });

        await resetProductsViewAsync();

        result.forEach((element) => {
            addProductToViewAsync(element);
        });
    }
    catch (error) {
        console.log(error);
        return;
    }
};

async function applySearchFilterAsync(filterName, filterValue) {
    searchFilters[filterName] = filterValue;

    console.log(searchFilters);

    await refreshProductsViewAsync();
}
async function removeSearchFilterAsync(filterName) {
    delete searchFilters[filterName];

    await refreshProductsViewAsync();
}

function registerAllFormFilters() {
    $('#filterBy').children('.form-group').each(function () {
        $(this).children('select').each(function () {
            this.addEventListener('change', () => {
                const filterName = $(this).attr('name');
                const filterValue = this.value;

                applySearchFilterAsync(filterName, filterValue);
            });
        });
    });
}
function registerAllFormOrderBys() {
    $('#orderBy').children('.form-group').each(function () {
        $(this).children('select').each(function () {
            this.addEventListener('change', () => {
                console.log('order by changed!');
            });
        });
    });
}

window.addEventListener('load', () => {
    registerAllFormFilters();
    registerAllFormOrderBys();

    refreshProductsViewAsync();
});