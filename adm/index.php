<? 
function show_form(){ 
        // ���������� ���� � ����������� ����������� � �� 
        require '../inc/connect.php'; 

        //������ ������ � ��, �� ������ ������ �� ��������� ��� ������� �� ����� �������� ��������, ������� �� �����, ��������� �� ������ ����� ��� ��� �� ������������. 
        $result = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."';", $link); 
        $row = mysql_fetch_array($result); 
?> 
<!-- ����� ���� ������� HTML --> 
<form action="" method="post"> 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td><p>����� ��������</p></td> 
</tr> 
<tr bgcolor="#ffffff"> 
  <td> 
      <textarea name="body" rows="20" cols="59" class="enter"> 
                <?// "<?=" ���� �����, ��� � "<? echo", �.�. ����� �� �����, ��� ������� ������� ����� ;-) ?> 
                <?=stripslashes($row['body']);?> 
      </textarea> 
  </td> 
</tr> 
<tr> 
  <td bgcolor="#1F2760" align="right"> 
      <input type="hidden" name="id" value="<?=$_GET['id'];?>"> 
      <input type="submit" value="���������" name="edit"> 
  </td> 
</tr> 
</table> 
</form> 
<?php 
} // ������� show_form() ����������� 

function complete(){ 
      // ���������� ���� � ����������� ����������� - ��� �� ��� �����. 
      require '../inc/connect.php'; 

      // ������ ������ � �� � ������� �������� �������� ��������� � �������� id. �� ������ ������ �� �� ������� ��� �� ����� ��������, ������ ������ ������ ������ ���. 
      $result = mysql_query("SELECT * FROM pages WHERE id = '".$_POST['id']."';", $link); 

      // ������������ ������ �� MySQL � ������� ������������� ������ 
      $row = mysql_fetch_array($result); 

      // ��������� �� ���� �� ������� ������� id. ���� ����, ������ ��������� ���� ������ � �� 
      if(empty($row['id'])) 
            $query = "INSERT INTO pages (body) VALUES ('".mysql_real_escape_string($_POST['body'])."' 
)"; 
      // � ��� ���� �� ����, ������ � ���� id ��� ���� ������ � � ������ ������ �� �� ������ ������������� 
      else 
            $query = "UPDATE pages SET 
                                     body = '".mysql_real_escape_string($_POST['body'])."' 
                     WHERE id = '".$_POST['id']."';"; 

      // ��������������� ���������� ���� ������ � ���� (�� ����� �� ������ ���������, ��� ���� �������, � ������ ������) 
      mysql_query($query, $link); 

      // �� � ������ ������� ��������� �������, ��� ������ ��������� 
      echo '<h3>������ ���������</h3>'; 
} 
function show_pages() { 
        require '../inc/connect.php'; 
        echo ' 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td> 
     <a href="?id=new">�������� ��������</a> 
  </td> 
</tr> 
</table>'; 
        echo ' 
<table cellspacing="1" cellpadding="2" bgcolor="#1F2760"> 
<tr bgcolor="#B0ADC3"> 
  <td> 
     <b>����� ��������</b> 
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

// ������� ��������� �������, ��� ��� ���� � ��������� ��� ������. ����� ���� ������� html, � ������� ����������� ������ � ��, � ������� �� ������ ������� ��� ���� ������ ������������ �� �� id. ��������������, ������ ���������� �� ���� id �� ������� �������, ����� � ���� ����� ���� �����. ������, �� �������� � ����� ��� ������� ;-) 

if($_POST['edit']) complete(); // ���� ���� ������ �������� "���������", ������� ��������� edit - ����� �������� ������ complete() 
if($_GET['id']) show_form(); // ���� �� ������ �� ������ � ������� show_pages(), �� ������ �� �������� � ���������� $_GET['id'] ��� ����� id, ������� ��� ����������. ������� � ���� ����� �������� ����� �������������� ����� ���������. 
else show_pages(); // ��, � ���� �� �� ������� ������������ id - ��������� ���� ������� ������ id. 
?>