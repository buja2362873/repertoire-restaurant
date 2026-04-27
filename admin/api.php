<?php
session_start();
require_once 'db_connection.php';

// Check if user is authenticated
if (!isset($_SESSION['admin_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$action = $_GET['action'] ?? '';
$table = $_POST['table'] ?? '';
$response = ['success' => false];

if (empty($table) || !preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $table)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid table name']);
    exit;
}

/**
 * Handle file uploads and convert to base64
 */
function handleFileUploads() {
    $imageKeywords = ['image', 'photo', 'picture', 'img', 'visual', 'illustration'];
    $data = $_POST;
    
    // Process each file input
    foreach ($_FILES as $fieldName => $file) {
        if ($file['error'] === UPLOAD_ERR_NO_FILE) {
            continue;
        }
        
        if ($file['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('File upload error: ' . $file['error']);
        }
        
        // Check if it's an image field
        $isImageField = false;
        foreach ($imageKeywords as $keyword) {
            if (stripos($fieldName, $keyword) !== false) {
                $isImageField = true;
                break;
            }
        }
        
        if ($isImageField) {
            // Validate file is actually an image
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimeType = finfo_file($finfo, $file['tmp_name']);
            finfo_close($finfo);
            
            if (strpos($mimeType, 'image/') !== 0) {
                throw new Exception('Invalid file type. Only images are allowed.');
            }
            
            // Convert to base64
            $imageData = file_get_contents($file['tmp_name']);
            if ($imageData === false) {
                throw new Exception('Failed to read file');
            }
            
            // Store as base64 data URL
            $data[$fieldName] = 'data:' . $mimeType . ';base64,' . base64_encode($imageData);
        }
    }
    
    return $data;
}

try {
    switch ($action) {
        case 'add':
            $data = handleFileUploads();
            
            // Remove system fields and action/table fields
            unset($data['table'], $data['action']);
            
            // Remove system fields that should never be set
            $systemFields = ['id', 'created_at', 'updated_at'];
            foreach ($systemFields as $field) {
                unset($data[$field]);
            }
            
            // Remove existing image placeholders (from edit mode)
            foreach ($data as $key => $value) {
                if (strpos($key, '_existing') !== false) {
                    unset($data[$key]);
                }
            }
            
            $columns = array_keys($data);
            $placeholders = array_fill(0, count($columns), '?');
            
            $sql = "INSERT INTO $table (" . implode(',', $columns) . ") VALUES (" . implode(',', $placeholders) . ")";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array_values($data));
            
            $response['success'] = true;
            $response['message'] = 'Record added successfully';
            break;

        case 'update':
            $id = $_POST['id'] ?? '';
            $idColumn = $_POST['idColumn'] ?? 'id';
            $data = handleFileUploads();
            
            unset($data['table'], $data['action'], $data['id'], $data['idColumn']);
            
            // Remove system fields that should never be modified
            $systemFields = ['id', 'created_at', 'updated_at'];
            foreach ($systemFields as $field) {
                unset($data[$field]);
            }
            
            // Handle existing images (if no new file was uploaded for that field)
            $imageFields = [];
            foreach ($data as $key => $value) {
                if (strpos($key, '_existing') !== false) {
                    $originalField = str_replace('_existing', '', $key);
                    // If the original field is not set (no new file), use the existing value
                    if (empty($data[$originalField])) {
                        $data[$originalField] = $value;
                    }
                    unset($data[$key]);
                }
            }
            
            $setParts = [];
            $values = [];
            foreach ($data as $key => $value) {
                $setParts[] = "$key = ?";
                $values[] = $value;
            }
            
            // Add updated_at timestamp
            $setParts[] = "updated_at = ?";
            $values[] = date('Y-m-d H:i:s');
            
            $values[] = $id;
            
            $sql = "UPDATE $table SET " . implode(',', $setParts) . " WHERE $idColumn = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($values);
            
            $response['success'] = true;
            $response['message'] = 'Record updated successfully';
            break;

        case 'delete':
            $id = $_POST['id'] ?? '';
            $idColumn = $_POST['idColumn'] ?? 'id';
            
            if (empty($id)) {
                throw new Exception('ID is required for deletion');
            }
            
            $sql = "DELETE FROM $table WHERE $idColumn = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$id]);
            
            $response['success'] = true;
            $response['message'] = 'Record deleted successfully';
            break;

        default:
            http_response_code(400);
            $response['error'] = 'Invalid action';
    }
} catch (Exception $e) {
    http_response_code(500);
    $response['success'] = false;
    $response['error'] = $e->getMessage();
    
    // Log error for debugging
    error_log("Admin API Error: " . $e->getMessage() . " - Action: " . $action);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
