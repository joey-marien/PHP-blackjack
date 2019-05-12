<?php
require_once('game.php');
$blackjack = new blackjack();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['start']))
    {
        $_SESSION['playing'] = true;

        $_SESSION['player'] = array();
        $_SESSION['player']['cards'] = [];
        $_SESSION['player']['score'] = NULL;

        $_SESSION['dealer'] = array();
        $_SESSION['dealer']['cards'] = [];
        $_SESSION['dealer']['score'] = NULL;
    }
    if(isset($_POST['hit']))
    {
        $blackjack->hit('player');
    }
    if(isset($_POST['stand']))
    {
        $blackjack->stand();
    }
    if(isset($_POST['stop']))
    {
        $blackjack->stop();
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blackjack</title>
</head>
<body>
<?php if(isset($_SESSION['msg'])) { echo '<h1>' . $_SESSION['msg'] . '</h1>'; } ?>
<?php if(isset($_SESSION['playing'])): ?>
    <p>Your cards: <?php $count = count($_SESSION['player']['cards']); $i = 0; foreach($_SESSION['player']['cards'] as $item) { if(++$i === $count) { echo $item; }else{ echo $item . ','; }} ?></p>
    <p>Your total: <?php echo $_SESSION['player']['score']; ?></p>
    <hr>
    <p>Dealer cards: <?php $count = count($_SESSION['dealer']['cards']); $i = 0; foreach($_SESSION['dealer']['cards'] as $item) { if(++$i === $count) { echo $item; }else{ echo $item . ','; }} ?></p></p>
    <p>Dealer total: <?php echo $_SESSION['dealer']['score']; ?></p>
    <form method="POST">
        <?php if(!isset($_SESSION['msg'])): ?>
        <input type="submit" value="Hit" name="hit">
        <input type="submit" value="Stand" name="stand">
        <?php else: ?>
        <input type="submit" value="Stop" name="stop">
        <?php endif; ?>
    </form>
<?php else: ?>
    <form method="POST">
        <input type="submit" value="Play" name="start">
    </form>
<?php endif; ?>
</body>
</html>