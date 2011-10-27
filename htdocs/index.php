<?php include 'header.php'; ?>
<?php
if (isset($_POST["status"]) && isset($_POST["id"])) {
  //echo $_POST["column"];
  //echo $_POST["id"];
  User::setUserStatus($_POST["id"], $_POST["status"]);
}
if (isset($_POST["comment"]) && isset($_POST["id"])) {
  //echo $_POST["comment"];
  //echo $_POST["id"];
  User::setUserComment($_POST["id"], $_POST["comment"]);
}

$attending = User::getStatusCount(User::ATTENDING);
$maby = User::getStatusCount(User::MABY);
?>

<div id="headnote">
  <h1>Registrera dig för innebandy v<?php echo date('W') ?></h1>
</div>
<div id="headnote-small">
  <h1>Innebandy v<?php echo date('W') ?></h1>
</div>
<div class="clear"></div>

<div id="headnote-info">
  <?php echo $attending; ?> kommer 
</div>
<div class="clear"></div>





<div class="theform">
  <div class="cell cell-name heading" ><a href="/players.php">Visitkort</a></div>
  <div class="cell check heading">X</div>
  <div class="cell check heading">Nej</div>
  <div class="cell check heading">?</div>
  <div class="cell check heading">Ja</div>
  <div class="cell ok heading ">&nbsp;</div>
  <div class="cell cellcomment heading" id="comment-head">Kommentar</div>
  <div class="cell cellextra heading" id="date-head">Datum</div>
  <div class="cell payed heading" id="payed-head">Betalt</div>
</div>
<div class="clear"></div>

<?php
  $users = new User;
  $result = $users->getUsers();
  while ($row = mysql_fetch_assoc($result)) {
    $today = date('Ymd');
    $date = date('Ymd', $row['unixdate']);
    $today == $date ? $date = '<span style="color:#3764DF;">idag ' . date('H:i', $row['unixdate']) . '</span>' : $date = date('j/n H:i', $row['unixdate']);
?>

    <form action="" method="post">
      <div class="theform">
        <div class="cell cell-name"><a href="/players.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></div>
        <div class="cell check"><input type="radio" name="status" value="0" <?php echo ($row['status'] == '0') ? 'checked' : ''; ?>/></div>
        <div class="cell check"><input type="radio" name="status" value="1" <?php echo ($row['status'] == '1') ? 'checked' : ''; ?> /></div>
        <div class="cell check"><input type="radio" name="status" value="2" <?php echo ($row['status'] == '2') ? 'checked' : ''; ?> /></div>
        <div class="cell check"><input type="radio" name="status" value="3" <?php echo ($row['status'] == '3') ? 'checked' : ''; ?> /></div>
        <div class="cell ok"><input type="submit"  value=" Ok " /></div>
        <div class="cell cellcomment" id="comment-body"><input type="text"  name="comment" value="<?php echo $row['comment'] ?>"  class="new-comment" /></div>
        <div class="cell cellextra" id="date-body"><?php echo $date; ?></div>
        <div class="cell payed" id="payed-body"><?php echo ($row['betalt'] == '1') ? 'Ja' : ''; ?></div>
      </div>
      <input type="hidden" name="id" value="<?php echo $row['id'] ?>" />
    </form>
      <div class="clear"></div>
<?php } ?>




<?php include 'footer.php'; ?>

