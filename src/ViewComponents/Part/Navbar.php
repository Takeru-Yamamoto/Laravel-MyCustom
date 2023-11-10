<?php

namespace MyCustom\ViewComponents\Part;

use MyCustom\ViewComponents\Part\Base\BasePartViewComponent;

class Navbar extends BasePartViewComponent
{
    /* view function user menu */
    final public function isViewUserMenuHeader(): bool
    {
        return config("mycustom.usermenu_header");
    }

    final public function isViewUserMenuBody(): bool
    {
        return config("mycustom.usermenu_body");
    }

    final public function isViewUserMenuFooter(): bool
    {
        return config("mycustom.usermenu_footer");
    }

    
    /* view function login/logout button */
    final public function isViewLoginButton(): bool
    {
        return !isLoggedIn() && config("mycustom.btn_login");
    }

    final public function isViewLogoutButton(): bool
    {
        return isLoggedIn() && config("mycustom.btn_logout");
    }
}
