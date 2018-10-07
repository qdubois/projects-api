<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 14/07/18
 * Time: 15:21
 */

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * @licence proprietary anaxago.com
 * Class ProjectFixtures
 * @package Anaxago\CoreBundle\DataFixtures\ORM
 */
class ProjectFixtures extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getProjects() as $project) {
            $projectToPersist = (new Project())
                ->setTitle($project['name'])
                ->setDescription($project['description'])
                ->setImageURL($project['imageURL'])
                ->setSlug($project['slug'])
                ->setCallForFund($project['callForFund'])
                ->setIsFunded($project['isFunded']);
            $manager->persist($projectToPersist);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getProjects(): array
    {
        return [
            [
                'name' => 'Fred de la compta',
                'description' => 'Dépoussiérer la comptabilité grâce à l\'intelligence artificielle',
                'slug' => 'fred-compta',
                'callForFund' => '4000000',
                'imageURL' => 'https://www.anaxago.com/uploads/media/teasercarousel/0001/96/thumb_95216_teasercarousel_widget.png',
                'isFunded' => false,
            ],
            [
                'name' => 'Mojjo',
                'description' => 'L\'intelligence artificielle au service du tennis : Mojjo transforme l\'expérience des joueurs et des fans de tennis grâce à une technologie unique de captation et de traitement de la donnée',
                'slug' => 'mojjo',
                'callForFund' => '600000',
                'imageURL' => 'https://www.anaxago.com/uploads/media/teasercarousel/0001/85/thumb_84096_teasercarousel_widget.png',
                'isFunded' => true,
            ],
            [
                'name' => 'Eole',
                'description' => 'Projet de construction d\'une résidence de 80 logements sociaux à Petit-Bourg en Guadeloupe par le promoteur Orion.',
                'slug' => 'eole',
                'callForFund' => '2000000',
                'imageURL' => 'https://picsum.photos/338/187/?random',
                'isFunded' => false,
            ],
        ];
    }
}
