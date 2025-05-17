<?php
class OrderItem {
    private $conn;
    private $table = 'order_items';

    public $id;
    public $order_id;
    public $product_id;
    public $quantity;
    public $price;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new order item
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET order_id = :order_id, product_id = :product_id, quantity = :quantity, price = :price";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Bind values
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":price", $this->price);

        return $stmt->execute();
    }

    // Read order items
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete order item
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind value
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Update order item
    public function update() {
        $query = "UPDATE " . $this->table . " SET quantity = :quantity, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->price = htmlspecialchars(strip_tags($this->price));

        // Bind values
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>
