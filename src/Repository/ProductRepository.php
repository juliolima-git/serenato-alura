<?php
namespace Serenatto\Web\Repository;

use PDO;
use Serenatto\Web\Model\Product;

class ProductRepository
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getProductByType($productType) : array | false {
        
        $query = "SELECT * FROM produtos WHERE tipo = ? ORDER BY preco";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $productType);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $formattedProducts = $this->hydrate($result);

        return $formattedProducts;
    }

    private function hydrate ($products) : array {
        $formattedProducts = array_map(function($product) {
            return new Product(
                $product['id'],
                $product['tipo'],
                $product['nome'],
                $product['descricao'],
                $product['preco'],
                $product['imagem']
            );
        }, $products);

        return $formattedProducts;
    
    }

}