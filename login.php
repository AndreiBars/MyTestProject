<?php
$dbc = mysqli_connect('localhost', 'root', '', 'PhotoSphere') OR DIE('Ошибка подключения к базе данных');
if(!isset($_COOKIE['user_id'])) {

    if(isset($_POST['submit'])) {

        $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
        $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        if(!empty($user_username) && !empty($user_password)) {
              $query = "SELECT `user_id` , `username` FROM `signup` WHERE username = '$user_username' AND password = SHA('$user_password')";
              $data = mysqli_query($dbc,$query);
              if(mysqli_num_rows($data) == 1) {
                  $row = mysqli_fetch_assoc($data);
                  setcookie('user_id', $row['user_id'], time() + (60*60*24*30));
                  setcookie('username', $row['username'], time() + (60*60*24*30));
                  $home_url = 'http://' . $_SERVER['HTTP_HOST'];
                  header('Location: '. $home_url);
              		$check = ture;
                  session_start();
                  $_SESSION["user_id"] = $_COOKIE['user_id'];
                  echo 'Yahooooooo!';
                  exit();
              }
              else {
                echo 'Извините, вы должны ввести правильные имя пользователя и пароль';
              }
        }
        else {
          echo 'Извините вы должны заполнить поля правильно';
        }
    }
}

// if(!isset($_SESSION["name"]))
// {
//   echo 'вы уже авторизованы'
// }
// else {
//   сюда можно кинуть форму
// }
//
// if(!isset($_POST["exit_login"]))
// {
//   unset($_SESSION[name]);
//   session_destroy();
// }
// else {
//   // echo 'form.....'сюда можно кинуть форму для выхода
// }

?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log in</title>
  <link rel="stylesheet" href="css/styles.css">
  <link href= "https://fonts.googleapis.com/css?family=Roboto:400,700" rel="sidebar">
  <link rel="SHORTCUT ICON" href="media/ico/logo_mini.png" type="image/gif">
</head>
<body>

  <div class="overlay_popup"></div>

<div class="LISU_form">


    <form class="content_LISU" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <span class="LISU_form_marg">Enter the data</span>

          <div class="entry LISU_form_marg">
             <input class="entry_field" type="text" name="username" placeholder="LOGIN">
          </div>

          <div class="entry LISU_form_marg">
             <input class="entry_field" type="password" name="password" placeholder="PASSWORD">
          </div>

          <div class="bt_entry LISU_form_marg">
              <button class="bt_entry_text" type="submit" name="submit">Sign up</button>
          </div>

    </form>
</div>




</body>
</html>
