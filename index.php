<?
include('header.php');
// �������� � �������� header.php
?>
<TD id="tdr">
<!------- ����� �������� ����� � ������ �������� -------->
<H2>������� ��������</H2>

</TD>
</TR>
</TABLE>

<?
// �������� � �������� footer.php
include("footer.php");
?>
include('main.php');

<?
        require 'inc/connect.php';

        //htmlspecialchars() ����������� ����������� ������� � HTML ��������, ����� ������� ��� ����, ����� ���������� ������� �������� ��� ���� ����������.
        $_GET['id'] = htmlspecialchars($_GET['id']);

        // ���� � ��� �� ����������� ������� ������������ ��������, �� ����� �������� ���� ����� ������. ���� �� �� ����� �������, ��������� ������ �������� ������������� ��� ���������, ������� �� ������ �� ������� �� ���������
        if(empty($_GET['id'])) $_GET['id'] = 1;
        $result = mysql_query("SELECT * FROM pages WHERE id = '".$_GET['id']."';", $link);
        $row = mysql_fetch_array($result);
?>
<html>
<head>
  <title></title>
</head>
<body>
<!-- ���� ������ �������, �� ��������: -->
<a href="?id=1">������� ��������</a>
<a href="?id=2">��������� �������</a>
<a href="?id=2">����� ��-���� ������������</a>
<a href="?id=3">��������</a><br /><br />
<?//stripslashes() - ������� ������������� �������� - � �� �� ����������� � �������, ����� ��������� ������ � ���� � ������� ������� mysql_real_escape_string()?>
<?=stripslashes($row['body']);?>
</body>
</html>