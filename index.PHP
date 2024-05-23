<!DOCTYPE html>
<html lang="ko">
	<head>
		<meta charset="UTF-8">
		<title>
			성적 조회 사이트
		</title>
	</head>

	<body>
		<h2>
			회원가입
		</h2>

		<form action="signup.php" method="post">
			ID: <input type="text" name="id" required><br>
			PW: <input type="password" name="pw" required><br>
			이름: <input type="text" name="name" required><br>
			학과: <input type="text" name="dept" required><br>
			전화번호: <input type="text" name="tel" required><br>

			<input type="submit" value="가입">
		</form>

		<hr>

		<h2>
			로그인
		</h2>

		<form action="login.php" method="post">
			ID: <input type="text" name="id" required><br>
			PW: <input type="password" name="pw" required><br>

			<input type="submit" value="로그인">
		</form>

<?php
		session_start();

		if (isset($_SESSION['id'])) {
			echo 	'<form action="logout.php" method="post">
					<input type="submit" value="로그아웃">
				</form>';
			echo 	'<a href="dashboard.php">
					<button>
						성적 입력 및 조회 화면으로 이동
					</button>
				</a>';
		}
?>
	</body>
</html>
