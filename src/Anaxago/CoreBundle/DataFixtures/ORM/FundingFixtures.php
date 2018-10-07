<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 06/10/18
 * Time: 12:08
 */

namespace Anaxago\CoreBundle\DataFixtures\ORM;

use Anaxago\CoreBundle\Entity\Funding;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class FundingFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        foreach ($this->getFundings() as $funding) {
            $fundingToPersist = (new Funding())
                ->setUserID($funding['userID'])
                ->setProjectID($funding['projectID'])
                ->setFunding($funding['funding']);
            $manager->persist($fundingToPersist);
        }
        $manager->flush();
    }

    /**
     * @return array
     */
    public function getFundings(): array
    {
        return [
            [
                'userID' => '1',
                'projectID' => '3',
                'funding' => '20000',
            ],
            [
                'userID' => '2',
                'projectID' => '2',
                'funding' => '400000',
            ],
            [
                'userID' => '1',
                'projectID' => '2',
                'funding' => '200000',
            ],
            [
                'userID' => '3',
                'projectID' => '1',
                'funding' => '30000',
            ],
        ];
    }
}