<?php

namespace Snenko\Task2\Block;

use Magento\Framework\View\Element\Template;
use Snenko\Task2\Model;
use Magento\Store\Model\StoreManagerInterface;

class Style extends Template
{

    protected $style;

    protected $text;
    protected $flag;
    protected $storeManager;

    public function __construct(
        StoreManagerInterface $storeManager,
        Model\Style $style,
        Template\Context $context,
        array $data = [])
    {

        $this->style = $style;
        $this->storeManager = $storeManager;

        parent::__construct($context, $data);
    }

    protected function _toHtml()
    {
        if(!$this->text && !$this->flag) {
            $text = null;
            $style = $this->style->getItems(['store'=>$this->storeManager->getStore()->getId()]);

            if(!$style) {
                $style = $this->style->getItems(['store'=>0]);
            }

            if($style) {
                foreach ($style as $button_id=>$color) {
                    $text .= '#' . $button_id . '{ color:' . $color . '; } ';
                }
                if($text){
                    $text = "<style>{$text}</style>";
                }
                $this->text = $text;
            }
            $this->flag = true;
        }
        return $this->text;
    }
    
}