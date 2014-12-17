<?
include('header.php');
// Включить в страницу header.php
?>
<TD id="tdr">
<!------- Здесь вводятся текст и ссылки рисунков -------->
<H2>Главная страница</H2>


<?
// Включить в страницу footer.php
include("footer.php");
?>
include('main.php');

<?
        require 'inc/connect.php';

        //htmlspecialchars() Преобразует специальные символы в HTML сущности, будем считать для того, чтобы простейшие попытки взломать наш сайт обломались.
        $_GET['id'] = htmlspecialchars($_GET['id']);

        // если у нас не запрашивали никакую определенную страницу, то будем выводить нашу самую первую. Если Вы ее давно удалили, поставьте вместо единички идентификатор той странички, которую Вы хотели бы грузить по умолчанию
        if(empty($_GET['id'])) $_GET['id'] = 1;
        $result = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."';", $link);
        $row = mysql_fetch_array($result);
?>
<html>
<head>
  <title></title>
</head>
<body>
<!-- меню делаем ручками, по принципу: -->
<a href="?id=1">главная страница</a>
<a href="?id=2">Категории номеров</a>
<a href="?id=2">Форма он-лайн бронирования</a>
<a href="?id=3">контакты</a><br /><br />
<?//stripslashes() - Удаляет экранирование символов - а их мы понаставили в админке, когда загружали данные в базу с помощью функции mysql_real_escape_string()?>
<?=stripslashes($row['body']);?>
</body>
</html>
