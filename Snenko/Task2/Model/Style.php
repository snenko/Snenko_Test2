<?php

namespace Snenko\Task2\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Cache\TypeListInterface;

class Style extends AbstractModel
{
    const CONF_PATH = 'snenko_button_skype';
    const COLOR_ARGUMENT = "color";
    const STORE_ARGUMENT = "store";
    const ID_ARGUMENT = "id";

    protected $scopeConfig;
    protected $configWriter;
    protected $configReader;
    protected $cacheTypeList;
    protected $storeRepository;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        WriterInterface $configWriter,
        TypeListInterface $cacheTypeList,
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->scopeConfig = $scopeConfig;
        $this->configWriter = $configWriter;
        $this->cacheTypeList = $cacheTypeList;
        parent::__construct($context,$registry,$resource,$resourceCollection,$data);
    }

    protected function confCacheClean()
    {
        $this->cacheTypeList->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER);
    }

    protected function getStore(array $params)
    {
        return key_exists(self::STORE_ARGUMENT, $params) ? $params[self::STORE_ARGUMENT] : 0;
    }

    public function getItems($params=[])
    {
        $value = $this->scopeConfig->getValue(
            self::CONF_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES,
            $this->getStore($params)
        );

        return $value ? unserialize($value) : null;
    }

    public function removeItems($params=[])
    {
        $this->configWriter->delete(
            self::CONF_PATH,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORES,
            $this->getStore($params)
        );

        $this->confCacheClean();
    }

    public function addItem($params)
    {
        if(isset($params[self::ID_ARGUMENT]) && isset($params[self::COLOR_ARGUMENT]) ) {

            $items = $this->getItems();
            $items[$params[self::ID_ARGUMENT]] = $params[self::COLOR_ARGUMENT];

            $this->configWriter->save(
                self::CONF_PATH,
                serialize($items),
                \Magento\Store\Model\ScopeInterface::SCOPE_STORES,
                $this->getStore($params)
            );

            $this->confCacheClean();

            return true;
        }
        return false;
    }

}