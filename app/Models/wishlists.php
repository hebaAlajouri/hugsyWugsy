<?php
class Wishlist {
    private $conn;
    private $table = 'wishlist';

    public $id;
    public $user_id;
    public $product_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new wishlist item
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET user_id = :user_id, product_id = :product_id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));

        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);

        return $stmt->execute();
    }

    // Read wishlist items
    public function read() {
        $query = "SELECT * FROM " . $this->table . " WHERE user_id = :user_id ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->execute();
        return $stmt;
    }

    // Delete wishlist item
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind value
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>
