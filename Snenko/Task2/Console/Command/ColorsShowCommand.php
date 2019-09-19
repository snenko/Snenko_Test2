<?php

namespace Snenko\Task2\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class ColorsShowCommand extends BaseCommand
{
    /**
     * {@inheritdoc}
     */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    )
    {
        $params = $this->getParams($input);

        if(!$this->isVerefication($output, $params)) return;

        if($items = $this->style->getItems($params)){
            $output->writeln("DOM element id color List");
            $i=1;
            foreach ($items as $id=>$color) {
                $output->writeln($i++.". | {$id} | {$color};");
            }

        }else{
            $output->writeln("List of styles is empty:");
        }

    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName("scandiweb:colors-show");
        $this->setDescription("Remove css button colors");

        $this->addStoreArgument();

        parent::configure();
    }



}