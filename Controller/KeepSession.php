<?php

namespace Controller;

use Model\Member;

class KeepSession
{
    public function __construct()
    {
        $isLoggedIn = false;
        if (!empty($_SESSION["user_id"])) {
            $isLoggedIn = true;
        } else if (!empty($_COOKIE["u"]) && !empty($_COOKIE["p"]) && !$isLoggedIn) {
            if (!empty($_COOKIE["u"]) && !empty($_COOKIE["p"])) {
                $member = new Member;
                $helper = new Helper;
                $result = $member->check_user($helper->decrypt($_COOKIE["u"]), $_COOKIE["p"], false);
                if (!empty($result)) {
                    $_SESSION['user_id'] = $result->user_id;
                    $_SESSION['first_name'] = $result->first_name;
                    $_SESSION['last_name'] = $result->last_name;
                    $_SESSION['email'] = $result->email;
                    $_SESSION['birthdate'] = $result->birthdate;
                    $_SESSION['user_type'] = $result->user_type;
                    $_SESSION['redirect_url'] = SITE_URL . '/admin/';
                } else {
                    setcookie('u', "", time() - 1, '/');
                    setcookie('p', "", time() - 1, '/');
                }
            }
        }
    }
}
