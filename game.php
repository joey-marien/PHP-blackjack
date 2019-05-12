<?php
session_start();

class blackjack
{
    function hit($user)
    {
        array_push($_SESSION[$user]['cards'], rand(1, 11));
        $_SESSION[$user]['score'] = array_sum($_SESSION[$user]['cards']);
        $this->check($user);
    }
    function stand()
    {
        do {
            $this->hit('dealer');
        } while (
            $_SESSION['dealer']['score'] <= 15
        );
    }
    function stop()
    {
        session_destroy();
        header("Refresh:0");
    }
    function check($user)
    {
        if ($user == 'player') {
            if ($_SESSION['player']['score'] == 21) {
                $_SESSION['msg'] = 'You won!';
            }
            else if ($_SESSION['player']['score'] > 21) {
                $_SESSION['msg'] = 'You lost!';
            }
        } if($user == 'dealer') {
            if($_SESSION['dealer']['score'] > 21)
            {
                $_SESSION['msg'] = 'You won!';
            }
        else if($_SESSION['player']['score'] > $_SESSION['dealer']['score'])
        {
            $_SESSION['msg'] = 'You won!';
        }
        else if($_SESSION['player']['score'] < $_SESSION['dealer']['score'])
        {
            $_SESSION['msg'] = 'You lost!';
        }
        else if ($_SESSION['player']['score'] == $_SESSION['dealer']['score']) {
            $_SESSION['msg'] = 'Draw!';
        }
        }
    }
}