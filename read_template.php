
<?php if(isset($_COOKIE["id"]) && $_COOKIE["id"]!=0){ ?>
<div class="kep"><?= $_COOKIE["user"] ?> /


 <a href="/" class="btn btn-default btn-flat" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
     <i class="fa fa-lock"></i> Выход
  </a>
  <form id="logout-form" method="POST" style="display: none;">
    <input type="hidden" name="logout">
  </form>

    <hr></div>
<?php } ?>



<?php

if(isset($_COOKIE["id"]) && $_COOKIE["id"]!=0){}else{ ?>

<div class="auth">

<table width="100%">
<tr>
<td width="50%" valign="top">
<h3>Авторизация</h3>
<form method="post">
    <input type="hidden" name="auth">
<p>
Login: <input type="text" name="login" class="amail" placeholder="Login..." required>
</p>
<p>
Password:<input type="password" name="password" class="avpas" placeholder="Password..." required>
</p>
<button class="button">Ok</button>
</form>

</td>

<td width="50%">
<h3>Регистрация</h3>
<form method="post"><input type="hidden" name="register">
  <p>
Имя: <input name="name" type="text" placeholder="Имя..." id="rname" required>
  </p>

<table width="100%">

    <tr>
        <td>
Login: <input type="text" name="login" class="amail" placeholder="Login..." required>
        </td>
        <td>
E-mail: <input type="email" name="email" placeholder="Email..." id="rmail" required>
        </td>
    </tr>

    <tr>
        <td>
Password:<input type="password" name="password" class="regpas" placeholder="Password..." id="password" required>
        </td>
        <td>
Password:<input type="password" name="password2" class="regpas" placeholder="Password..." id="password-check" required>
        </td>
    </tr>
</table>
<button class="button">Ok</button>
</form>

</td>
</tr>


</table>

<hr>
</div>
<?php } ?>



<div class="sent">

<h3>Тестовое задание</h3>
<form method="post"><input type="hidden" name="sent">
 <?php if(isset($_COOKIE["id"]) && $_COOKIE["id"]!=0){}else{ ?>
  <p>
Имя: <input name="name" type="text" placeholder="Имя..." id="sname" <?php if(isset($_COOKIE["id"]) && $_COOKIE["id"]!=0){ ?> required <?php } ?>
><br>
  </p>

<p>
E-mail: <input type="email" name="email" placeholder="Email..." id="smail" <?php if(isset($_COOKIE["id"]) && $_COOKIE["id"]!=0){ ?> required <?php } ?>><br>
</p>
<?php } ?>
<p>
Текст задачи:<br><textarea class="textarea" rows="5" placeholder="..." name="text" required></textarea>
</p>

<button class="button full">Ok</button>

</form>

</div>



<div class="filtr"><hr>
<h3>Фильтр</h3>
<form method="post"><input type="hidden" name="filtr">
|| &#8593;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'name ASC'){ ?> checked=checked <?php } ?>  value="1">

&#8595;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'name DESC'){ ?> checked=checked <?php } ?>  value="2">
имя пользователя ||
&#8593;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'email ASC'){ ?> checked=checked <?php } ?> value="3">
&#8595;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'email DESC'){ ?> checked=checked <?php } ?> value="4">

email ||
&#8593;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'perm ASC') { ?> checked=checked <?php } ?> value="5">
&#8595;<input type="radio" name="filtr" <?php if(isset($_COOKIE["filtr"]) && $_COOKIE["filtr"] == 'perm DESC') { ?> checked=checked <?php } ?> value="6">


статус ||
<button class="fbut">Ok</button>
</form><hr>
</div>

<div class="zadach">

<?php if ($total_rows > 0) { ?>

<table width="100%" border="2" class="table">
<thead>
    <tr>
      <th style=" width: 3%;">#</th>
      <th style=" width: 15%;">имя пользователя</th>
      <th style=" width: 15%;">email</th>

    <?php if(!empty($_COOKIE["perm"]) && $_COOKIE["perm"]==1){ ?>
      <th>текст задачи</th>
      <th style=" width: 3%;">&#128505;</th>
      <th style=" width: 50px;">&#x21bb;</th>


    <?php }else{ ?>
      <th>текст задачи</th>
      <th style=" width: 15%;">статус</th>
      <th style=" width: 3%;" title="Отредактировано администратором">&#9997;</th>
      <th style=" width: 3%;" title="Выполнено">&#128505;</th>


    <?php } ?>

    </tr>
  </thead>
</table>

<?php

 while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
?>

 <?php if(!empty($_COOKIE["perm"]) && $_COOKIE["perm"]==1){ ?>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="update">
        <input type="hidden" name="tid" value="<?=$id ?>">
    <table width="100%" border="2" class="table">
    <tr>
      <th style=" width: 3%;"><?=$id ?></th>
      <td style=" width: 15%;"><?=$name ?></td>
      <td style=" width: 15%;"><?=$email ?></td>
      <td ><textarea class="textarea2" placeholder="..." name="text" <?php if($active == 1){ ?> disabled="disabled" <?php } ?>><?=$text ?></textarea></td>
      <td  style=" width: 3%;" align="center"><input type="checkbox" name="active" <?php if($active == 1){ ?> checked="checked" <?php } ?>> </td>
      <td  style=" width: 50px;" align="center"><button>&#x21bb;</button></td>
      </tr>
  </table>
</form>

  <?php }else{ ?>
<table width="100%" border="2" class="table">
    <tr>
      <th style=" width: 3%;"><?=$id ?></th>
      <td style=" width: 15%;"><?=$name ?></td>
      <td style=" width: 15%;"><?=$email ?></td>
      <td style=" width: 563px;"><?=$text ?></td>
      <td style=" width: 15%;"><?php if($perm == 1 ){echo 'Админ';}else{echo 'Гость';} ?></td>

      <?php if($redak == 1){ ?> <td style=" width: 3%;" align="center" title="Отредактировано администратором">&#128396; </td> <?php }else{ ?> <td style=" width: 3%;" align="center">  </td> <?php } ?>

      <?php if($active == 1){ ?><td style=" width: 3%;" align="center" title="Выполнено"> &#128505; <?php }else{ ?> <td style=" width: 3%;" align="center" title="Не выполнено"> &#65794; <?php } ?></td>

    </tr>
 </table>
 <?php } ?>



    <?php } ?>



<?php include_once 'paging.php'; } else { ?>
    <div class='alert alert-danger'>Информация не найдено.</div>
<?php } ?>

</div>

