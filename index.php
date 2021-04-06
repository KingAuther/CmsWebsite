<?php
// (A) CONTENT CLASS
class Content {
  // (A1) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo;
  private $stmt;
  public $error;
  function __construct () {
    try {
      $this->pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET,
        DB_USER, DB_PASSWORD, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
      );
    }
    catch (Exception $ex) {
      die($ex->getMessage());
    }
  }
  
  // (A2) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    $this->pdo = null;
    $this->stmt = null;
  }
  
  // (A3) GET CONTENT
  function get ($id) {
    $this->stmt = $this->pdo->prepare("SELECT * FROM `contents` WHERE `content_id`=?");
    $this->stmt->execute([$id]);
    return $this->stmt->fetch(PDO::FETCH_NAMED);
  }
  
  // (A4) SAVE CONTENT
  function save ($title, $text, $id=null) {
    if (is_numeric($id)) {
      $sql = "REPLACE INTO `contents` (`content_id`, `content_title`, `content_text`) VALUES (?,?,?)";
      $data = [$id, $title, $text];
    } else {
      $sql = "INSERT INTO `contents` (`content_title`, `content_text`) VALUES (?,?)";
      $data = [$title, $text];
    }
    try {
      $this->stmt = $this->pdo->prepare($sql);
      $this->stmt->execute($data);
    } catch (Exception $ex) {
      $this->error = $ex->getMessage();
      return false;
    }
    return true;
  }
}

// (B) DATABASE SETTINGS - CHANGE THESE TO YOUR OWN!
define('DB_HOST', 'localhost');
define('DB_NAME', 'test');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

// (C) CREATE NEW CONTENT OBJECT
$_CORE = new Content();