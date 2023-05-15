<?php

namespace es\ucm\fdi\aw\forms;

use es\ucm\fdi\aw\DAO\CategoryDAO;
use es\ucm\fdi\aw\DAO\ManufacturerDAO;
use es\ucm\fdi\aw\DAO\ProductCategoryDAO;
use es\ucm\fdi\aw\DAO\ProductDAO;
use es\ucm\fdi\aw\DAO\ProductManufacturerDAO;
use es\ucm\fdi\aw\DTO\ProductCategoryDTO;
use es\ucm\fdi\aw\DTO\ProductDTO;
use es\ucm\fdi\aw\DTO\ProductManufacturerDTO;

require_once 'includes/config.php';

class AddProductForm extends Form
{
    //  Constants
    private const FORM_ID = 'addProduct_form';
    private const URL_REDIRECTION = 'products.php';
    private const ENCODE_TYPE = 'multipart/form-data';

    //  Constructors
    public function __construct()
    {
        parent::__construct(
            self::FORM_ID,
            array(
                parent::URL_REDIRECTION_KEY => self::URL_REDIRECTION,
                parent::ENCODE_TYPE_KEY => self::ENCODE_TYPE
            )
        );
    }

    //  Methods
    protected function processForm($data)
    {
        $targetDir = IMAGES_ROOT . "/products/";
        $imgName = basename($_FILES["fileToUpload"]["name"]);
        $targetFile = $targetDir . $imgName;

        $isImage = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

        if (!$isImage)
            $this->m_Errors['file_not_image'] = "Este archivo no es una imagen";

        if (file_exists($targetFile))
            $this->m_Errors['iamge_already_exists'] = "Esta imagen ya se ha subido antes, pruebe con otra por favor";

        if (count($this->m_Errors) > 0)
            return;

        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile);

        $productDAO = new ProductDAO;

        $name = $data["name"];
        $price = $data["price"];
        $description = $data["description"];
        $offer = $data["offer"];

        $product = $productDAO->create(new ProductDTO(null, $name, $description, $imgName, $price, $offer));

        $product = $productDAO->readLastProduct()[0];

        $manufacturerID = $data["manufacturer"];
        $categoryID = $data["category"];

        $productManufacturerDAO = new ProductManufacturerDAO();
        $productCategoryDAO = new ProductCategoryDAO();

        $productManufacturerDAO->create(new ProductManufacturerDTO($product->getID(), $manufacturerID));
        $productCategoryDAO->create(new ProductCategoryDTO($product->getID(), $categoryID));
    }
    protected function generateFormFields($data)
    {
        $errorsHTML = '';

        if (count($this->m_Errors) > 0) {
            foreach ($this->m_Errors as $error) {
                $errorsHTML .= <<<HTML_ERROR
                <div class="alert alert-danger m-2 justify-content-center align-center" role="alert">
                    <b>Error:</b> {$error}
                </div>
                HTML_ERROR;
            }
        }

        $manufacturerDAO = new ManufacturerDAO();
        $manufacturersResults = $manufacturerDAO->read();
        $manufacturersOptions = '';
        $manufacturerIndex = 0;

        foreach ($manufacturersResults as $manufacturer) {

            $id = $manufacturer->getID();
            $name = $manufacturer->getName();
            $isSelected = $manufacturerIndex == 0 ? "selected" : "";
            $manufacturerIndex++;

            $manufacturersOptions .=
                <<<HTML
                    <option value="{$id}" {$isSelected}>{$name}</option>
                HTML;
        }

        $categoryDAO = new CategoryDAO();
        $categoriesResults = $categoryDAO->read();
        $categoriesOptions = '';
        $categoryIndex = 0;

        foreach ($categoriesResults as $category) {

            $id = $category->getID();
            $name = $category->getName();
            $isSelected = $categoryIndex == 0 ? "selected" : "";
            $categoryIndex++;

            $categoriesOptions .=
                <<<HTML
                    <option value="{$id}" {$isSelected}>{$name}</option>
                HTML;
        }

        return <<<HTML_FORM
        <div class="container shadow">

        {$errorsHTML}

        <div class="row m-3 p-4">
            <div class="col-12 my-1">
                <label for="name" class="form-label">Nombre del producto</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="col-6 my-1">
                <label for="price" class="form-label">Precio del producto</label>
                <input type="number" step=".01" class="form-control" name="price" required>
            </div>
            <div class="col-6 my-1">
                <label for="price" class="form-label">Oferta del producto</label>
                <div class="input-group">
                    <input type="number" min="0" max="100" class="form-control" name="offer" required>
                    <span class="input-group-text">%</span>
                </div>
            </div>
            <div class="form-group my-1">
                <label for="textBox" class="form-label">Descripción del producto</label>
                <textarea class="form-control" style="resize: none;" rows="10" name="description"></textarea>
            </div>
            <div class="col-6 my-1">
                <label for="manufacturer">Fabricante</label>
                <select name="manufacturer" class="form-control">
                    {$manufacturersOptions}
                </select>
            </div>
            <div class="col-6 my-1">
                <label for="category">Categoría</label>
                <select name="category" class="form-control">
                    {$categoriesOptions}
                </select>
            </div>
            <div class="col-12 my-3">
                Imagen del producto:<br>
                <input class="card mt-2 p-2" type="file" name="fileToUpload">
            </div>
            <input type="submit" value="Añadir" class="btn btn-primary my-3">
        </div>
        HTML_FORM;
    }
}
