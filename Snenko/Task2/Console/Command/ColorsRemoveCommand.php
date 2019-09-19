<?php

namespace Snenko\Task2\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class ColorsRemoveCommand extends BaseCommand
{
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $params = $this->getParams($input);

        if(!$this->isVerefication($output, $params)) return;

        $this->style->removeItems($params);

        $output->writeln("All colors removed.");

        if ($input->getOption(self::OPTION_CACHE)) {
            $this->cacheClean();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("scandiweb:colors-remove");
        $this->setDescription("Remove css button colors");

        $this->addStoreArgument();

        $this->addCacheOption();

        parent::configure();
    }



}