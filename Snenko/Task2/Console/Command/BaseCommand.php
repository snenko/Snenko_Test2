<?php

namespace Snenko\Task2\Console\Command;

use Symfony\Component\Console\Command\Command;
use Snenko\Task2\Model\Style;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Magento\Store\Model\StoreRepository;
use Magento\Framework\App\Cache;

class BaseCommand extends Command
{

    const OPTION_CACHE = 'cache';

    protected $style;
    protected $cacheTypeList;
    protected $cacheManager;
    protected $storeRepository;

    public function __construct(
        Style $style,
        Cache\Manager $cacheManager,
        StoreRepository $storeRepository,
        $name = null
    ) {
        $this->style = $style;
        $this->cacheManager = $cacheManager;
        $this->storeRepository = $storeRepository;
        parent::__construct($name);
    }

    protected function addCacheOption()
    {
        $this->addOption(
            self::OPTION_CACHE,
            null,
            InputOption::VALUE_NONE,
            'Clean cache without run cache:clean'
        );
    }

    protected function addColorArgument()
    {
        $this->addArgument(
            $this->style::COLOR_ARGUMENT,
            InputArgument::REQUIRED,
            "Color"
        );
    }

    protected function addStoreArgument()
    {
        $this->addArgument(
            $this->style::STORE_ARGUMENT,
            InputArgument::OPTIONAL,
            "Store"
        );
    }

    protected function addIdArgument()
    {
        $this->addArgument(
            $this->style::ID_ARGUMENT,
            InputArgument::REQUIRED,
            "Color"
        );

    }

    protected function getParams(InputInterface $input)
    {
        $arg_arr = [
            $this->style::STORE_ARGUMENT,
            $this->style::COLOR_ARGUMENT,
            $this->style::ID_ARGUMENT
        ];
        $params = [];

        foreach ($arg_arr as $arg) {

            if(!$input->hasArgument($arg)) continue;

            if($value = $input->getArgument($arg)) {

                if($arg == $this->style::STORE_ARGUMENT && $value) {
                    $value = $this->getStoreId($value);
                }

                $params[$arg] = $value;
            }
        }

        return $params;
    }

    protected function isVerefication(OutputInterface $output, $params= [])
    {
        $arg = $this->style::STORE_ARGUMENT;

        if(in_array($arg, $params)){
            if(!$this->getStoreId($params[$arg])){
                $output->write("<info> Store [{$params[$arg]}] is not correct </info>");
                return false;
            }
        }

        return true;
    }

    protected function cacheClean()
    {
        $this->cacheManager->clean(['config', 'block_html', 'full_page']);
    }

    protected function getStoreId($storeCode)
    {
        return $this->storeRepository->getActiveStoreByCode($storeCode)->getId() ;
    }
}