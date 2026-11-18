<?php

declare(strict_types=1);

namespace Magenable\OpenAIAgenticCommerceFeed\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Backend\Block\Template\Context;
use Magenable\OpenAIAgenticCommerceFeed\ViewModel\LastGenerationDate as LastGenerationDateViewModel;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Magento\Framework\Data\Form\Element\AbstractElement;

class LastGenerationDate extends Field
{
    /**
     * @var LastGenerationDateViewModel
     */
    private LastGenerationDateViewModel $viewModel;

    /**
     * Initialize the configuration field template.
     *
     * @param Context $context
     * @param LastGenerationDateViewModel $viewModel
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        Context $context,
        LastGenerationDateViewModel $viewModel,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $data['template'] = 'Magenable_OpenAIAgenticCommerceFeed::system/config/last-generation-date.phtml';
        parent::__construct($context, $data, $secureRenderer);
        $this->viewModel = $viewModel;
    }

    /**
     * @inheritdoc
     */
    protected function _prepareLayout()
    {
        if (!$this->viewModel->getDate()) {
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
        if (!$this->viewModel->getDate()) {
            return '';
        }
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return the configuration field view model.
     *
     * @return LastGenerationDateViewModel
     */
    public function getViewModel(): LastGenerationDateViewModel
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
