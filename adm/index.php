<? 
function show_form(){ 
        // подключаем файл с настройками подключения к БД 
        require '../inc/connect.php'; 

        //делаем запрос к БД, на данный момент на следующие две строчки не стоит обращать внимание, объясню их потом, посокльку на данном этапе они еще не используются. 
        $result = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."';", $link); 
        $row = mysql_fetch_array($result); 
?> 
<!-- далее идет обычный HTML --> 
<form action="" method="post"> 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td><p>Текст страницы</p></td> 
</tr> 
<tr bgcolor="#ffffff"> 
  <td> 
      <textarea name="body" rows="20" cols="59" class="enter"> 
                <?// "<?=" тоже самое, что и "<? echo", т.е. вывод на экран, что выводим объясню позже ;-) ?> 
                <?=stripslashes($row['body']);?> 
      </textarea> 
  </td> 
</tr> 
<tr> 
  <td bgcolor="#1F2760" align="right"> 
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input type="submit" value="отправить" name="edit"> 
  </td> 
</tr> 
</table> 
</form> 
<?php 
} // функция show_form() закончилась 

function complete(){ 
      // подключаем файл с настройками подключения - это мы уже знаем. 
      require '../inc/connect.php'; 

      // делаем запрос к БД в котором пытаемся вытащить страничку с указаным id. На данный момент мы не сделали еще ни одной страницы, посему запрос вернет пустой ряд. 
      $result = mysql_query("SELECT * FROM pages WHERE id = '".$_POST['id']."';", $link); 

      // перекидываем данные из MySQL в пхпшный ассоциативный массив 
      $row = mysql_fetch_array($result); 

      // проверяем не пуст ли элемент массива id. Если пуст, значит вставляем наши данные в БД 
      if(empty($row['id'])) 
            $query = "INSERT INTO pages (body) VALUES ('".mysql_real_escape_string($_POST['body'])."' 
)"; 
      // а вот если не пуст, значит с этим id уже есть запись и в данном случае мы ее просто отредактируем 
      else 
            $query = "UPDATE pages SET 
                                     body = '".mysql_real_escape_string($_POST['body'])."' 
                     WHERE id = '".$_POST['id']."';"; 

      // непосредственно записываем наши данные в базу (до этого мы просто описывали, что надо сделать, а теперь делаем) 
      mysql_query($query, $link); 

      // ну и просто выводим крикливую надпись, что скрипт отработал 
      echo '<h3>Данные обновлены</h3>'; 
} 
function show_pages() { 
        require '../inc/connect.php'; 
        echo ' 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td> 
     <a href="?id=new">Добавить страницу</a> 
  </td> 
</tr> 
</table>'; 
        echo ' 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td> 
     <b>Номер страницы</b> 
  </td> 
</tr>'; 
        $result = mysql_query("SELECT * FROM pages ORDER BY id;", $link); 
        while($row = mysql_fetch_array($result)){ 
               echo ' 
<tr bgcolor="#ffffff"> 
  <td> 
     <a href="?id='.$row['id'].'">'.$row['id'].'</a> 
  </td> 
</tr>'; 
        } 
        echo ' 
</table>'; 

} 

// функция настолько простая, что мне даже и объяснять там нечего. Опять идет обычный html, в котором встречается запрос к БД, в котором мы просим вывести все наши записи отсортировав их по id. Соответственно, каждый полученный из базы id мы выводим ссылкой, чтобы в него можно было зайти. Короче, ща запустим и будет все понятно ;-) 

if($_POST['edit']) complete(); // если была нажата кнопочка "отправить", которая именуется edit - тогда вызываем функию complete() 
if($_GET['id']) show_form(); // если мы нажали на ссылку в функции show_pages(), то значит мы передали в переменную $_GET['id'] тот самый id, который нас интересует. Поэтому в этом слчае вызываем форму редактирования нашей странички. 
else show_pages(); // ну, а если мы не выбрали определенный id - запускаем нашу функцию выбора id. 
?>