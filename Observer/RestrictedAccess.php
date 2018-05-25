<?php
/**
 * Created by PhpStorm.
 * User: chutienphuc
 * Date: 25/05/2018
 * Time: 16:26
 */
namespace Phucct\RestrictedAccess\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Event\ManagerInterface;
use Magento\Framework\App\Response\Http;
use Magento\Framework\UrlFactory;
use Magento\Framework\App\ActionFlag;
use Magento\Customer\Model\Session;

class RestrictedAccess implements ObserverInterface
{
    /*
     * @var Http
     */
    private $response;

    /*
     * @var UrlFactory
     */
    private $urlFactory;
    
    /*
     * @var Session
     */
    private $session;
    
    /*
     * @var ActionFlag
     */
    private $actionFlag;
    
    public function __construct(
        Http $response,
        UrlFactory $urlFactory,
        Session $session,
        ActionFlag $actionFlag
    ) {
        $this->response = $response;
        $this->urlFactory = $urlFactory;
        $this->session = $session;
        $this->actionFlag = $actionFlag;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $allowedRoutes = [
            'customer_account_login',
            'customer_account_loginpost',
            'customer_account_create',
            'customer_account_createpost',
            'customer_account_logoutsuccess',
            'customer_account_confirm',
            'customer_account_confirmation',
            'customer_account_forgotpassword',
            'customer_account_forgotpasswordpost',
            'customer_account_createpassword',
            'customer_account_resetpasswordpost',
            'customer_section_load'
        ];

        $request = $observer->getEvent()->getRequest();
        $isCustomerLoggedIn = $this->session->isLoggedIn();
        $actionFullName = strtolower($request->getFullActionName());

        if (!$isCustomerLoggedIn && !in_array($actionFullName, $allowedRoutes)) {
            $this->response->setRedirect($this->urlFactory->create()->getUrl('customer/account/login'));
        }
    }
}
