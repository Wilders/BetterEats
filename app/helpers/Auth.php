<?php

namespace app\helpers;

use app\models\Utilisateur;
use Exception;

/**
 * Class Auth
 * @package app\helpers
 */
final class Auth {

    /**
     * Attempt to connect
     */
    public static function attempt($email, $password) {
        try {
            if(self::check()) throw new Exception();
            $user = Utilisateur::where('email', '=', $email)->firstOrFail();
            if (!password_verify($password, $user->password)) throw new Exception();
            $_SESSION['user'] = $user;
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Get current user
     */
    public static function user() {
        $res = null;
        if (self::check()) {
            $_SESSION['user']->refresh();
            $res = $_SESSION['user'];
        }
        return $res;
    }

    /**
     * Check if user is logged in
     */
    public static function check() {
        return isset($_SESSION['user']);
    }

    /**
     * Log out the user
     */
    public static function logout() {
        unset($_SESSION['user']);
    }
}
