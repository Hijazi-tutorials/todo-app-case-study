<?php

class RedirectHelper
{
    static function redirectToPreviousPage() : void
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}