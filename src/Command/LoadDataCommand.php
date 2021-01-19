<?php

namespace App\Command;

use App\Entity\CoordinatesLog;
use App\Service\BaseJob;
use App\Service\Endpoints;
use App\Service\GeoService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class LoadDataCommand extends Command
{
    protected static $defaultName = 'app:load-data';

    /**
     * @var GeoService
     */
    private $geo;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ParameterBagInterface
     */
    private $params;

    public function __construct(GeoService $geo, EntityManagerInterface $em, ParameterBagInterface $params)
    {
        $this->geo = $geo;

        $this->em = $em;

        $this->params = $params;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription('For get addresses')
            ->addArgument('filename', InputArgument::REQUIRED, 'Wrote a full name of the file')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @param ObjectManager $manager
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $job = new BaseJob();

        $pathToFile = $this->params->get('kernel.project_dir') . '/public/';

        $fileData = array_map('str_getcsv', file($pathToFile  . $input->getArgument('filename')));

        $output->writeln([
            '============Geo data loader============',
            '=======================================',
            '',
        ]);

        for ($i = 0; $i <= count($fileData) - 1; $i++) {
            $coord = preg_split('/\s+/', $fileData[$i][0]);

            $lat = trim($coord[0]);

            $lon = trim($coord[1]);

            $out = $this->geo->call(GeoService::SERVICE, 'GET', Endpoints::GEO_DATA, $job->setFormat('jsonv2')->setLat($lat)->setLon($lon)->toQuery() );

            $coordinates = new CoordinatesLog();

            $coordinates->setLatitude($lat);

            $coordinates->setLongitude($lon);

            $coordinates->setFullAddress($out['display_name']);

            $this->em->persist($coordinates);

            $output->writeln([
                'Write this data :' . $lat .' and ' . $lon . 'address ' . $out['display_name'],
                '=======================================',
            ]);

            $this->em->flush();
        }

        $io->success('All data Load');

        return 0;
    }
}
