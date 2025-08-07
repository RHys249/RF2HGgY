<?php
// 代码生成时间: 2025-08-07 15:20:27
// Inventory Management System using PHP and Yii Framework
// Filename: inventory_management.php
// Description: Handles the inventory management operations such as adding, updating, deleting, and retrieving inventory items.

class InventoryManagement {
    // Database connection
    private $db;

    // Constructor to initialize database connection
    public function __construct($db) {
        $this->db = $db;
    }

    // Function to add a new inventory item
    public function addItem($itemData) {
        try {
            // Validate item data
            if (empty($itemData['name']) || empty($itemData['quantity']) || empty($itemData['price'])) {
                throw new Exception('Invalid item data');
            }

            // Prepare SQL statement to prevent SQL injection
            $sql = "INSERT INTO inventory (name, quantity, price) VALUES (" . $this->db->quoteValue($itemData['name']) . ", ".$_ . $itemData['quantity'] . ", ".$_ . $this->db->quoteValue($itemData['price']) . ")";

            // Execute SQL statement
            $this->db->createCommand($sql)->execute();

            return 'Item added successfully';
        } catch (Exception $e) {
            // Error handling
            return 'Error: ' . $e->getMessage();
        }
    }

    // Function to update an existing inventory item
    public function updateItem($itemId, $itemData) {
        try {
            // Validate item data
            if (empty($itemData['name']) || empty($itemData['quantity']) || empty($itemData['price'])) {
                throw new Exception('Invalid item data');
            }

            // Prepare SQL statement to prevent SQL injection
            $sql = "UPDATE inventory SET name = " . $this->db->quoteValue($itemData['name']) . ", quantity = ".$_ . $itemData['quantity'] . ", price = " . $this->db->quoteValue($itemData['price']) . " WHERE id = ".$_ . $itemId . "";

            // Execute SQL statement
            $this->db->createCommand($sql)->execute();

            return 'Item updated successfully';
        } catch (Exception $e) {
            // Error handling
            return 'Error: ' . $e->getMessage();
        }
    }

    // Function to delete an inventory item
    public function deleteItem($itemId) {
        try {
            // Prepare SQL statement to prevent SQL injection
            $sql = "DELETE FROM inventory WHERE id = ".$_ . $itemId . "";

            // Execute SQL statement
            $this->db->createCommand($sql)->execute();

            return 'Item deleted successfully';
        } catch (Exception $e) {
            // Error handling
            return 'Error: ' . $e->getMessage();
        }
    }

    // Function to retrieve inventory items
    public function getItems() {
        try {
            // Prepare SQL statement
            $sql = "SELECT * FROM inventory";

            // Execute SQL statement and fetch results
            $results = $this->db->createCommand($sql)->queryAll();

            return $results;
        } catch (Exception $e) {
            // Error handling
            return 'Error: ' . $e->getMessage();
        }
    }
}

// Usage example:
// $db = new CDbConnection('mysql:host=localhost;dbname=inventory_db', 'username', 'password');
// $inventoryManager = new InventoryManagement($db);
// echo $inventoryManager->addItem(['name' => 'Product 1', 'quantity' => 10, 'price' => 19.99]);
// echo $inventoryManager->updateItem(1, ['name' => 'Updated Product 1', 'quantity' => 15, 'price' => 24.99]);
// echo $inventoryManager->deleteItem(1);
// echo '<pre>' . print_r($inventoryManager->getItems(), true) . '</pre>';
