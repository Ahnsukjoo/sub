<?php
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
	$name = $_POST['name'];
	$dept = $_POST['dept'];
	$tel = $_POST['tel'];

	$sql = "INSERT INTO info (id, pw, name, dept, tel) VALUES ('$id', '$pw', '$name', '$dept', '$tel')";

	if ($conn->query($sql) === TRUE) {
		echo 	"<script>
				alert('회원가입이 완료되었습니다.');
			</script>";
		echo	"<script>
				window.location.href='index.php';
			</script>";
	}
	else {
		echo	"<script>
				alert('Error: 회원가입에 실패했습니다.');
			</script>";
		echo 	"<script>
				window.location.href='index.php';
			</script>";
	}

	$conn->close();
?>
