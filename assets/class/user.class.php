<?php
	session_start();
	require_once("../php/config.php");

	$type = htmlspecialchars(strip_tags($_POST['type']));

class UserRegister {

	private $name;
	private $email;
	private $pass;
	private $confirmPass;
	private $error = false;
	private $ip;

	function __construct($name, $email, $pass, $confirmPass, $ip) {
		$this->name = htmlspecialchars(strip_tags($name));
		$this->email = htmlspecialchars($email);
		$this->pass = $pass;
		$this->confirmPass = $confirmPass;
		$this->ip = $ip;
		self::validateForms();
	}

	private function validateForms() {
		global $pdo;
		if(empty($this->name) || empty($this->email) || empty($this->pass) || empty($this->confirmPass)) {
			$this->error = true;
			$_SESSION['error'][0] = 'Valores do formulário estão vazios';
		} else {
			if(strlen($this->name) < 10) {
				$this->error = true;
				$_SESSION['error'][1] = 'Digite seu nome completo.';
			} else if((strlen($this->pass) < 6) || (strlen($this->confirmPass) < 6)) {
				$this->error = true;
				$_SESSION['error'][2] = 'Sua senha precisa ter no mínimo 6 caracteres.';
			}
		}

		if(!$this->error) {
			$sql = "SELECT id FROM users WHERE email = :e";
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':e', $this->email);
			$stmt->execute();
			if($stmt->rowCount() > 0) {
				$_SESSION['error'][4] = 'Usuário já cadastrado.';
				header("Location: ../../register.php");
			} else {
				$this->pass = md5($this->pass);
				self::sendUser();
			}
		} else {
			header("Location: ../../register.php");
		}
	}

	private function sendUser() {
		global $pdo;

		$sql = "INSERT INTO users (nome, email, senha, ip) VALUES (:n, :e, :s, :i)";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':n', $this->name);
		$stmt->bindParam(':e', $this->email);
		$stmt->bindParam(':s', $this->pass);
		$stmt->bindParam(':i', $this->ip);
		$result = $stmt->execute();

		if(!$result) {
			$_SESSION['error'][3] = 'Erro ao cadastrar.';
		} else {
			$_SESSION['success'] = 'Cadastrado com sucesso, logue no sistema.';
			header("Location: ../../index.php");
		}
	}
}

class UserLogin {
	private $email;
	private $pass;

	function __construct($email, $pass) {
		$this->email = htmlspecialchars(strip_tags($email));
		$this->pass = md5($pass);
		self::loginUser();
	}

	private function loginUser() {
		global $pdo;
		$sql = "SELECT * FROM users WHERE email = :e AND senha = :s";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':e', $this->email);
		$stmt->bindParam(':s', $this->pass);
		$stmt->execute();
		if($stmt->rowCount() == 0) {
			$_SESSION['error'][4] = 'Usuário não cadastrado ou senha errada.';
			header("Location: ../../index.php");
		} else {
			$user = $stmt->fetch(PDO::FETCH_ASSOC);
			$_SESSION['name'] = $user['nome'];
			$_SESSION['email'] = $user['email'];
			header("Location: ../../inicio.php");
		}
	}
}
if($type=='register') {
	try {

		$ip = $_SERVER['REMOTE_ADDR'];

		$user = new UserRegister($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'], $ip);

	} catch(Error $e) {

		echo "<br>Você não passou os dados do formulário:". $e->getMessage();

	}
} else if($type=='login') {
	try {

		$ip = $_SERVER['REMOTE_ADDR'];

		$user = new UserLogin($_POST['email'], $_POST['password']);

	} catch(Error $e) {

		echo "<br>Você não passou os dados do formulário:". $e->getMessage();

	}
}