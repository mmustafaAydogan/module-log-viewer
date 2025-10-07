<?php
/**
 * Created by PhpStorm.
 * @author: mustafa.aydogan
 */

namespace Mustafa\LogViewer\Controller\Adminhtml\Logs;


use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
 const ADMIN_RESOURCE = 'Mustafa_LogViewer::logviewer';

 protected $resultPageFactory;

    public function __construct(Context $context, PageFactory $resultPageFactory)
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE);
        $resultPage->getConfig()->getTitle()->prepend(__('Log Viewer'));

        return $resultPage;
    }
}
 
