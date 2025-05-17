<?php
class Message {
    private $conn;
    private $table = 'messages';

    public $id;
    public $sender_id;
    public $receiver_id;
    public $content;
    public $status;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new message
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET sender_id = :sender_id, receiver_id = :receiver_id, content = :content, status = :status, created_at = :created_at";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->sender_id = htmlspecialchars(strip_tags($this->sender_id));
        $this->receiver_id = htmlspecialchars(strip_tags($this->receiver_id));
        $this->content = htmlspecialchars(strip_tags($this->content));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        // Bind values
        $stmt->bindParam(":sender_id", $this->sender_id);
        $stmt->bindParam(":receiver_id", $this->receiver_id);
        $stmt->bindParam(":content", $this->content);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":created_at", $this->created_at);

        return $stmt->execute();
    }

    // Read messages for a user
    public function read() {
        $query = "SELECT * FROM " . $this->table . " WHERE receiver_id = :receiver_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":receiver_id", $this->receiver_id);
        $stmt->execute();
        return $stmt;
    }

    // Update message status (e.g., read/unread)
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

    // Delete message
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
