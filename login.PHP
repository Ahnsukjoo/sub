<?php
	session_start();

	$servername = "localhost";
	$username = "Grade";
	$password = "abcd";
	$dbname = "web_db";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	$id = $_POST['id'];
	$pw = $_POST['pw'];

	$sql = "SELECT * FROM info WHERE id='$id' AND pw='$pw'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$_SESSION['id'] = $id;
		echo 	"<script>
				alert('로그인 성공');
				window.location.href='index.php';
			</script>";
	}
	else {
		echo 	"<script>
				alert('로그인 실패');
				window.location.href='index.php';
			</script>";
	}

	$conn->close();
?>
