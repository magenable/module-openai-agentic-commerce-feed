<?php

declare(strict_types=1);

namespace Magenable\OpenAIAgenticCommerceFeed\Block\Adminhtml\System\Config;

use Magento\Config\Block\System\Config\Form\Field;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Helper\SecureHtmlRenderer;
use Magento\Framework\Data\Form\Element\AbstractElement;

class GenerateFeedFiles extends Field
{
    /**
     * Initialize the configuration field template.
     *
     * @param Context $context
     * @param array $data
     * @param SecureHtmlRenderer|null $secureRenderer
     */
    public function __construct(
        Context $context,
        array $data = [],
        ?SecureHtmlRenderer $secureRenderer = null
    ) {
        $data['template'] = 'Magenable_OpenAIAgenticCommerceFeed::system/config/generate-feed-files.phtml';
        parent::__construct($context, $data, $secureRenderer);
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
     * @inheritdoc
     */
    protected function _getElementHtml(AbstractElement $element): string
    {
        $originalData = $element->getOriginalData();
        $this->addData(
            [
                'button_label' => __($originalData['button_label']),
                'html_id' => $element->getHtmlId(),
                'ajax_url' => $this->_urlBuilder->getUrl(
                    'magenable_openai_agentic_commerce_feed/system_config/generatefeedfiles'
                ),
                'field_mapping' => str_replace('"', '\\"', json_encode($this->_getFieldMapping()))
            ]
        );

        return $this->_toHtml();
    }

    /**
     * Return the configuration fields sent with the feed request.
     *
     * @return array
     */
    protected function _getFieldMapping()
    {
        return [
            'file_format' => 'magenable_openai_agentic_commerce_feed_general_file_format'
        ];
    }
}
