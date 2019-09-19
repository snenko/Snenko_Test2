<?php

namespace Snenko\Task2\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ColorChangeCommand extends BaseCommand
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $params = $this->getParams($input);

        if(!$this->isVerefication($output, $params)) return;

        if($this->style->addItem($params)){
            $output->writeln("Changed color;");

            if ($input->getOption(self::OPTION_CACHE)) {
                $this->cacheClean();
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("scandiweb:color-change");
        $this->setDescription("add css button color. Format [color] [id]");

        $this->addColorArgument();
        $this->addIdArgument();
        $this->addStoreArgument();

        $this->addCacheOption();

        parent::configure();
    }



}