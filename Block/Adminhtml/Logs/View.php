<?php
/**
 * Created by PhpStorm.
 * @author: mustafa.aydogan
 * @copyright: Mnm (http://www.mnm.com.tr)
 * Date: 7.10.2025
 * Time: 10:11
 */

namespace Mustafa\LogViewer\Block\Adminhtml\Logs;

use Magento\Backend\Block\Template;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class View extends Template
{
    protected $filesystem;

    public function __construct(
        Template\Context $context,
        Filesystem $filesystem,
        array $data = []
    ) {
        $this->filesystem = $filesystem;
        parent::__construct($context, $data);
    }

    public function getLogFiles()
    {
        $logDirectory = $this->filesystem->getDirectoryRead(DirectoryList::LOG);
        $logDir = $logDirectory->getAbsolutePath();

        $files = glob($logDir . '*.log');

        if (empty($files)) {
            return ['system.log'];
        }

        return array_map('basename', $files);
    }
}
