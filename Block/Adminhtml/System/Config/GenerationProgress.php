<?php

declare(strict_types=1);

namespace Magenable\OpenAIAgenticCommerceFeed\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Backend\Block\Template\Context;
use Magenable\OpenAIAgenticCommerceFeed\ViewModel\GenerationProgress as GenerationProgressViewModel;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Magento\Framework\Data\Form\Element\AbstractElement;

class GenerationProgress extends Field
{
    /**
     * @var GenerationProgressViewModel
     */
    private GenerationProgressViewModel $viewModel;

    /**
     * Initialize the configuration field template.
     *
     * @param Context $context
     * @param GenerationProgressViewModel $viewModel
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        Context $context,
        GenerationProgressViewModel $viewModel,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $data['template'] = 'Magenable_OpenAIAgenticCommerceFeed::system/config/generation-progress.phtml';
        parent::__construct($context, $data, $secureRenderer);
        $this->viewModel = $viewModel;
    }

    /**
     * @inheritdoc
     */
    public function render(AbstractElement $element)
    {
        $element = clone $element;
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * Return the configuration field view model.
     *
     * @return GenerationProgressViewModel
     */
    public function getViewModel(): GenerationProgressViewModel
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
                'ajax_url' => $this->_urlBuilder->getUrl(
                    'magenable_openai_agentic_commerce_feed/system_config/generationprogress'
                ),
            ]
        );

        return $this->_toHtml();
    }
}
