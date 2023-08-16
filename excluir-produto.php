<?php

use Serenatto\Web\Infrastructure\Persistence\ConnectionCreator;
use Serenatto\Web\Repository\ProductRepository;

require_once 'vendor/autoload.php';

$idProduct = $_POST['id'];

$repository = new ProductRepository(ConnectionCreator::createConnection());

$repository->delete($idProduct);

header('Location: ./admin.php');

