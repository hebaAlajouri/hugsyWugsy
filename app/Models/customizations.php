<?php
use App\Http\Controllers\Admin\AdminCustomizationController;
class Customization {
    private $conn;
    private $table = 'customizations';

    public $id;
    public $user_id;
    public $product_id;
    public $color;
    public $accessories;
    public $embroidery;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create new customization
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET user_id = :user_id, product_id = :product_id, color = :color, accessories = :accessories, embroidery = :embroidery";
        $stmt = $this->conn->prepare($query);

        // Sanitize input
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->color = htmlspecialchars(strip_tags($this->color));
        $this->accessories = htmlspecialchars(strip_tags($this->accessories));
        $this->embroidery = htmlspecialchars(strip_tags($this->embroidery));

        // Bind values
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":color", $this->color);
        $stmt->bindParam(":accessories", $this->accessories);
        $stmt->bindParam(":embroidery", $this->embroidery);

        return $stmt->execute();
    }

    // Read customizations
    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Delete customization
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
