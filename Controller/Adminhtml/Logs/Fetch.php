<?php
/**
 * Created by PhpStorm.
 * @author: mustafa.aydogan
 */

namespace Mustafa\LogViewer\Controller\Adminhtml\Logs;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem\DirectoryList;

class Fetch extends Action
{
    const ADMIN_RESOURCE = 'Mustafa_LogViewer::logviewer';

    protected $jsonFactory;
    protected $directoryLinks;

    public function __construct(Context $context, JsonFactory $jsonFactory, DirectoryList $directoryLinks)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->directoryLinks = $directoryLinks;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        try {
            $logDir = $this->directoryLinks->getPath(\Magento\Framework\App\Filesystem\DirectoryList::LOG);
            $fileName = $this->getRequest()->getParam('file', 'system.log');
            $offset = (int)$this->getRequest()->getParam('offset', 0);
            $limit = (int)$this->getRequest()->getParam('limit', 100);
            $errorOnly = (bool)$this->getRequest()->getParam('error_only', false);
            $lastLine = $this->getRequest()->getParam('last_line', '');

            if (!preg_match('/^[a-zA-Z0-9_\-]+\.log$/', $fileName)) {
                throw new \Exception('Invalid file name');
            }
            $filePath = $logDir . '/' . $fileName;

            if (!file_exists($filePath)) {
                return $result->setData([
                    'success' => false,
                    'message' => 'Log file not found: ' . $fileName
                ]);
            }

            $lines = $this->readLogFile($filePath, $limit, $errorOnly);
            return $result->setData([
                'success' => true,
                'lines' => $lines,
                'file' => $fileName,
                'count' => count($lines)
            ]);

        } catch (\Throwable $throwable) {
            return $result->setData([
                'success' => false,
                'message' => sprintf("%s <--> %s <--> %s", $throwable->getMessage(), $throwable->getFile(), $throwable->getLine())
            ]);
        }
    }

    protected function readLogFile($filePath, $limit, $errorOnly)
    {
        $command = sprintf('tail -n %d %s', $limit, escapeshellarg($filePath));

        if ($errorOnly) {
            $command .= ' | grep -iE "(ERROR|CRITICAL|Exception|Fatal)"';
        }

        $output = shell_exec($command);

        if (empty($output)) {
            return [];
        }

        $lines = explode("\n", trim($output));

        return array_filter($lines, function($line) {
            return !empty(trim($line));
        });
    }
}
 
