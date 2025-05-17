<?php
class VoiceRecording {
    private $conn;
    private $table = 'voice_recordings';

    public $id;
    public $user_id;
    public $file_path;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new voice recording
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET user_id = :user_id, file_path = :file_path";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->file_path = htmlspecialchars(strip_tags($this->file_path));

        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":file_path", $this->file_path);

        return $stmt->execute();
    }

    // Read voice recordings
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete voice recording
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
