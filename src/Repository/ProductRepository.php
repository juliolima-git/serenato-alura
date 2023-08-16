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
                $product['nome'],
                $product['tipo'],
                $product['descricao'],
                $product['preco'],
                $product['imagem']
            );
        }, $products);

        return $formattedProducts;
    
    }

    public function getAllProducts() : array {

        $query = 'SELECT * FROM produtos order by tipo';
        
        $stmt = $this->pdo->query($query);
        
        return $this->hydrate($stmt->fetchAll());

    }

    public function delete($idProduct) : bool {
        
        $query = 'DELETE FROM produtos WHERE id = ?';

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $idProduct);
        
        $result = $stmt->execute();

        return $result;

    }

    public function save($product) : bool {

        $query = "INSERT INTO produtos (nome, tipo, descricao, preco, imagem) VALUES (?, ?, ?, ? ,?)";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $product->getName());
        $stmt->bindValue(2, $product->getType());
        $stmt->bindValue(3, $product->getDescription());
        $stmt->bindValue(4, $product->getPrice());
        $stmt->bindValue(5, $product->getImage());

        $result = $stmt->execute();

        return $result;

    }

    public function getProductBy($id) : Product {
        $query = "SELECT * FROM produtos WHERE id = ? ORDER BY preco";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        $product = $stmt->fetch();

        return new Product(
                $product['id'],
                $product['nome'],
                $product['tipo'],
                $product['descricao'],
                $product['preco'],
                $product['imagem']
        );

    }

    public function update($product) : bool { 
        $query ="UPDATE produtos 
                 SET nome = ?, tipo = ?, descricao = ?, preco = ?, imagem = ?
                 WHERE id = ?";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(1, $product->getName());
        $stmt->bindValue(2, $product->getType());
        $stmt->bindValue(3, $product->getDescription());
        $stmt->bindValue(4, $product->getPrice());
        $stmt->bindValue(5, $product->getImage());
        $stmt->bindValue(6, $product->getId());

        $result = $stmt->execute();

        return $result;
    }



}