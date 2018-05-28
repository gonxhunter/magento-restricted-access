<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 28/05/2018
 * Time: 17:29
 */

namespace Phucct\RestrictedAccess\Block;

class Notice extends \Magento\Framework\View\Element\Template
{
    public function getMessage()
    {
        return __('Please login to access this website');
    }
}
