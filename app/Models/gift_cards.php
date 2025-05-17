<?php
class GiftCard {
    private $conn;
    private $table = 'gift_cards';

    public $id;
    public $code;
    public $amount;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new gift card
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET code = :code, amount = :amount, status = :status";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->code = htmlspecialchars(strip_tags($this->code));
        $this->amount = htmlspecialchars(strip_tags($this->amount));
        $this->status = htmlspecialchars(strip_tags($this->status));

        // Bind values
        $stmt->bindParam(":code", $this->code);
        $stmt->bindParam(":amount", $this->amount);
        $stmt->bindParam(":status", $this->status);

        return $stmt->execute();
    }

    // Read gift cards
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update gift card status
    public function update() {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // Bind values
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    // Delete gift card
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
