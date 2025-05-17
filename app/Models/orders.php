<?php
class Order {
    private $conn;
    private $table = 'orders';

    public $id;
    public $user_id;
    public $total_price;
    public $status;
    public $created_at;
    public $updated_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new order
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET user_id = :user_id, total_price = :total_price, status = :status, created_at = :created_at, updated_at = :updated_at";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->total_price = htmlspecialchars(strip_tags($this->total_price));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":total_price", $this->total_price);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":updated_at", $this->updated_at);

        return $stmt->execute();
    }

    // Read orders
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete order
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind value
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Update order
    public function update() {
        $query = "UPDATE " . $this->table . " SET status = :status, updated_at = :updated_at WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));

        // Bind values
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":updated_at", $this->updated_at);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }
}
?>
