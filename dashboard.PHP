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

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$kor = $_POST['kor'];
		$eng = $_POST['eng'];
		$math = $_POST['math'];
		$id = $_SESSION['id'];

		$total = $kor + $eng + $math;
 		$avg = $total / 3;

		$sqlInsertOrUpdate = 	"INSERT INTO subject (id, kor, eng, math, total, avg) 
					VALUES ('$id', $kor, $eng, $math, $total, $avg)
					ON DUPLICATE KEY UPDATE kor=$kor, eng=$eng, math=$math, total=$total, avg=$avg";
		$conn->query($sqlInsertOrUpdate);

		$sqlUpdateRank = "SET @rank=0; 
				UPDATE subject SET rank=(@rank:=@rank+1) ORDER BY total DESC";
    
		if ($conn->multi_query($sqlUpdateRank)) {
			do {
				if ($result = $conn->store_result()) {
					$result->free_result();
				}
			}

			while ($conn->more_results() && $conn->next_result());
		}
		else {
			echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
		}
	}

	$id = $_SESSION['id'];
	$sqlSelect = "SELECT info.name, info.dept, subject.kor, subject.eng, subject.math, subject.total, subject.avg, subject.rank FROM info JOIN subject ON info.id = subject.id WHERE info.id='$id'";
	$result = $conn->query($sqlSelect);
?>

<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<title>
			내 웹사이트
		</title>
	</head>
	<body>
		<h2>
			성적 입력
		</h2>

		<form action="" method="post">
			국어: <input type="text" name="kor" required><br>
			영어: <input type="text" name="eng" required><br>
			수학: <input type="text" name="math" required><br>

			<input type="submit" value="입력">
		</form>

		<hr>

		<h2>
			성적 조회
		</h2>

		<table border="1">
			<tr>
				<th>이름</th>
				<th>학과</th>
				<th>국어</th>
				<th>영어</th>
				<th>수학</th>
				<th>총점</th>
				<th>평균</th>
				<th>석차</th>
			</tr>
<?php
			while ($row = $result->fetch_assoc()) {
				echo "<tr>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['dept'] . "</td>";
					echo "<td>" . $row['kor'] . "</td>";
					echo "<td>" . $row['eng'] . "</td>";
					echo "<td>" . $row['math'] . "</td>";
					echo "<td>" . $row['total'] . "</td>";
					echo "<td>" . $row['avg'] . "</td>";
					echo "<td>" . $row['rank'] . "</td>";
 				echo "</tr>";
			}
?>
		</table>
<?php
		if (isset($_SESSION['id'])) {
			echo	'<form action="logout.php" method="post">
					<input type="submit" value="로그아웃">
				</form>';
		}
		else {
			header("Location: index.php");
			exit;
		}
?>
	</body>
</html>
