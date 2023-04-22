'use strict'

let session = null;

const onSessionSuccess = (result) => {
    session = result;
};

const getAddProductButton = () => {
    return `
        <div class="d-flex flex-col col-xs-12 col-sm-12 col-md-6 col-lg-4 col-xxl-3 px-0">
            <a class="flex-fill d-inline-block d-sm-flex text-decoration-none" href="addProduct.php">
                <div class="flex-fill card shadow d-flex py-5 flex-col m-2 px-3 bg-primary text-white">
                    <div class="flex-fill d-flex align-items-center justify-content-center">
                        <i class="fa-solid fa-plus"></i>
                        Add product
                    </div>    
                </div>
            </a>
        </div>
    `;
};
const convertToProductHTML = (product) => {
    //  Fails if session hasn't loaded yet because of admin panel
    if (session === null)
        return;

    let productTextContent = '';
    let adminTextContent = '';

    //  Product
    if (product.offer != 0) {
        if (product.offer == 100 || product.price == 0) {
            productTextContent = `
                <b class=" text-decoration-line-through text-danger">${product.price}€</b>
                <b class="text-decoration text-success"> GRATIS! </b>
            `;
        } else {
            productTextContent = `
                <b>${Number(product.price).toFixed(2)}€</b>
                <b class="text-decoration-line-through text-danger">${product.price}€</b>
                <b class="text-decoration text-danger">OFERTA! </b>
            `;
        }
    }
    else {
        if (product.price == 0) {
            productTextContent = `
                <b class=" fs-4">${product.price}€</b>
                <b class="text-decoration text-success"> GRATIS! </b>
            `;
        }
        else {
            productTextContent = `
                <b class="fs-4">${product.price}€</b>
            `;
        }
    }

    console.log(session);

    //  Admin
    if (session.isAdmin) {
        adminTextContent = `
        <div class="col text-end">
            <a href="editProduct.php?productID=${product.id}" class="py-1 btn btn-dark">
                <i class="fa-solid fa-pen"></i>
            </a>
            <button type="button" class="py-1 btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#product-modal-${product.id}">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
        </div>
        `;
    }

    return `
        <div class="d-flex flex-col col-xs-12 col-md-6 col-lg-4 col-xxl-3 px-0">
            <div class="card shadow d-flex flex-col m-2 px-3">
                <div class="d-flex flex-fill" id="product-img">
                    <img class="img-fluid object-fit-contain" src="images/products/${product.imgName}">
                </div
                <div class="container-fluid">
                    <hr class="my-3">
                    <div class="text-start">
                        <a class="text-decoration-none text-reset" href="product.php?productID=${product.id}">${product.name}</a>
                    </div>
                    <div class="row mb-3">
                        <div class="col text-start">
                            <div class="text-black text-decoration-none">
                                ${productTextContent}
                            </div>
                        </div>
                        ${adminTextContent}
                    </div>
                </div>
            </div>
        </div>
    `;
}
const resetProductsView = () => {
    $('#products-root').empty();
    $('#products-root').append(getAddProductButton());
}
const addProductToView = (element) => {
    $('#products-root').append(convertToProductHTML(element));
}

window.addEventListener('load', () => {
    getSessionAsync(onSessionSuccess, null);
});