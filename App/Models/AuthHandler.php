<?php
//init
namespace App\Models;

//import classes
use App\Core\DatabaseManager As DatabaseManager;

//
class AuthHandler {
	//auth check
	public static function status(){
        //check session 
        if (!isset($_SESSION['user_id'])) {
            // Redirect to login page
            header("Location: /login?failed"); //
            exit;
        }

        return true;
	}

	//logout
	public static function logout(){
        // Destroy all session data
        session_unset();     // Unset all session variables
        session_destroy();   // Destroy the session

        // Optional: Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Redirect to login page
        header("Location: /login?logout=success"); //
        exit;		
	}

	
	//login
	public static function login($username, $password){
	    try {
	        // DB connection
	        $db = DatabaseManager::mysql();
	        $pdo = $db;

	        // Start transaction
	        $pdo->beginTransaction();

	        // Input
	        $username = $username ?? '';
	        $password = $password ?? '';

	        if (empty($username) || empty($password)) {
	            return [
	                "status" => "error",
	                "message" => "Username and password are required"
	            ];
	        }

	        // Fetch user and lock the row for update
	        $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username LIMIT 1 FOR UPDATE");
	        $stmt->execute([':username' => $username]);
	        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

	        // Combined check
	        if (!$user || !password_verify($password, $user['password'])) {
	            $pdo->rollBack();
	            return [
	                "status" => "error",
	                "message" => "Invalid username or password"
	            ];
	        }

	        // Check user active
	        if ($user['user_status_id'] != 1) {
	            $pdo->rollBack();
	            return [
	                "status" => "error",
	                "message" => "User account is inactive or blocked"
	            ];
	        }

	        // Update last_login
	        $updateStmt = $pdo->prepare("UPDATE user SET last_login = NOW() WHERE id = :id");
	        $updateStmt->execute([':id' => $user['id']]);

	        // Commit
	        $pdo->commit();

	        //assign sessions 
	        $_SESSION['name'] = $user["name"];
	        $_SESSION['user_id'] = $user["username"];

	        // Return response with accid
	        return [
	            "status" => "success",
	            "message" => "Login successful",
	            "user" => [
	                "username" => $user['username'],
	                "user_type_id" => $user['user_type_id'],
	                "last_login" => date('Y-m-d H:i:s')
	            ]
	        ];

	    } catch (\PDOException $e) {
	        if ($pdo && $pdo->inTransaction()) {
	            $pdo->rollBack();
	        }
	        return [
	            "status" => "error",
	            "message" => "Database error: " . $e->getMessage()
	        ];
	    }
	}

	//register
	public static function register($name, $email, $password, $user_type_id, $user_status_id){
		try {
		    // Prepare PDO object
		    $db = DatabaseManager::mysql();
		    $pdo = $db;

		    // Get user input (example from POST or other source)
		    $name = $name;
		    $username = $email;
		    $password = $password;
		    $user_type_id = $user_type_id;
		    $user_status_id = $user_status_id;

		    // Begin transaction
        	$pdo->beginTransaction();

		    // Check if username already exists
		    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM user WHERE username = :username");
		    $checkStmt->execute([':username' => $username]);
		    $userExists = $checkStmt->fetchColumn();

		    if ($userExists > 0) {
		    	// rollback
		    	$pdo->rollBack();

		        // Username already exists
		        return array(
		            "status" => "error",
		            "message" => "Username already exists"
		        );
		    }

		    // Hash the password
		    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

		    // Insert new user
		    $stmt = $pdo->prepare("
		        INSERT INTO user (name, username, password, user_type_id, user_status_id, last_login)
		        VALUES (:name, :username, :password, :user_type_id, :user_status_id, NULL)
		    ");

		    $stmt->execute([
		    	':name' => $name,
		        ':username' => $username,
		        ':password' => $hashedPassword,
		        ':user_type_id' => $user_type_id,
		        ':user_status_id' => $user_status_id
		    ]);

    	    // Commit transaction
	        $pdo->commit();

		    return array(
		        "status" => "success",
		        "message" => "User registered successfully"
		    );

		} catch (\PDOException $e) {
		    return array(
		        "status" => "error",
		        "message" => "Database error: " . $e->getMessage()
		    );
		}

	}


}
