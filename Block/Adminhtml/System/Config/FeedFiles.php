<?php

declare(strict_types=1);

namespace Magenable\OpenAIAgenticCommerceFeed\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Backend\Block\Template\Context;
use Magenable\OpenAIAgenticCommerceFeed\ViewModel\FeedFiles as FeedFilesViewModel;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Magento\Framework\Data\Form\Element\AbstractElement;

class FeedFiles extends Field
{
    /**
     * @var FeedFilesViewModel
     */
    private FeedFilesViewModel $viewModel;

    /**
     * Initialize the configuration field template.
     *
     * @param Context $context
     * @param FeedFilesViewModel $viewModel
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        Context $context,
        FeedFilesViewModel $viewModel,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $data['template'] = 'Magenable_OpenAIAgenticCommerceFeed::system/config/feed-files.phtml';
        parent::__construct($context, $data, $secureRenderer);
        $this->viewModel = $viewModel;
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        if (!$this->viewModel->getFiles()) {
            return $this;
        }
        parent::_prepareLayout();
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function render(AbstractElement $element)
    {
        if (!$this->viewModel->getFiles()) {
            return '';
        }
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return the configuration field view model.
     *
     * @return FeedFilesViewModel
     */
    public function getViewModel(): FeedFilesViewModel
    {
        return $this->viewModel;
    }

    /**
     * @inheritdoc
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $this->addData(
            [
                'html_id' => $element->getHtmlId(),
            ]
        );

        return $this->_toHtml();
    }
}
