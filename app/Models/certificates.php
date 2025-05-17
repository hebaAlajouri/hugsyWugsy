<?php
class Certificate {
    private $conn;
    private $table = 'certificates';

    public $id;
    public $order_id;
    public $user_id;
    public $certificate_number;
    public $issue_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new certificate
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET order_id = :order_id, user_id = :user_id, certificate_number = :certificate_number, issue_date = :issue_date";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->certificate_number = htmlspecialchars(strip_tags($this->certificate_number));
        $this->issue_date = htmlspecialchars(strip_tags($this->issue_date));

        // Bind values
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":certificate_number", $this->certificate_number);
        $stmt->bindParam(":issue_date", $this->issue_date);

        return $stmt->execute();
    }

    // Read certificates
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY issue_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete certificate
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
