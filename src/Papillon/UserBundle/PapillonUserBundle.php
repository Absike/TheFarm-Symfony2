<?php

namespace Papillon\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class PapillonUserBundle extends Bundle
{
    public function getParent(){
        return 'FOSUserBundle';
    }
}
