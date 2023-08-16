<?php

use Serenatto\Web\Infrastructure\Persistence\ConnectionCreator;
use Serenatto\Web\Model\Product;
use Serenatto\Web\Repository\ProductRepository;

require_once 'vendor/autoload.php';

$repository = new ProductRepository(ConnectionCreator::createConnection());

if(isset($_POST['cadastro'])) {
    $product = new Product(
        null,
        $_POST['nome'],
        $_POST['tipo'],
        $_POST['descricao'],
        $_POST['preco'],
        uniqid().$_FILES['imagem']['name']
    );

    if($_FILES['imagem']['error'] == UPLOAD_ERR_OK) {
        move_uploaded_file($_FILES['imagem']['tmp_name'], $product->getImagePath());
    }
}

$repository->save($product);

header("Location: admin.php");