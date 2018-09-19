<?php


namespace AppBundle\Command;

use AppBundle\Entity\Discs;
use AppBundle\Entity\KindergartenRegisterPage;
use AppBundle\Entity\Singers;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class SingersDiscsInitializerCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('singers:discs:initializer')
            ->setDescription('create Singers and Discs')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<info>Starting</info>");

        // get Entity manager
        $em = $this->getContainer()->get("doctrine")->getManager();

        $output->writeln("<info>Creating singers and discs</info>");

        $discSings = array('Confrontation'=>'Bob Marley','Loyal to the Game'=>'2pac');

        foreach($discSings as $disc => $sing){

            $singer = new Singers();
            $singer->setName($sing);
            $discs = new Discs();

            $discs->setName($disc);
            $discs->setSingers($singer);

            $em->persist($discs);
            $em->flush();

        }

        $output->writeln("<info>Success</info>");
    }

}

