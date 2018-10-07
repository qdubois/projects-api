<?php declare(strict_types = 1);
/**
 * Created by PhpStorm.
 * User: quentin
 * Date: 05/10/18
 * Time: 12:10
 */

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Project
 *
 * @ORM\Table(name="funding")
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\FundingRepository")
 */
class Funding
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @var int
     *
     * @ORM\Column(name="userID", type="integer")
     */
    private $userID;


    /**
     * @var int
     *
     * @ORM\Column(name="projectID", type="integer")
     *
     */
    private $projectID;


    /**
     * @var float
     *
     * @ORM\Column(name="funding", type="float")
     */
    private $funding;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set userID
     *
     * @param int $userID
     *
     * @return Funding
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get userID
     *
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }


    /**
     * Set projectID
     *
     * @param int $projectID
     *
     * @return Funding
     */
    public function setProjectID($projectID)
    {
        $this->projectID = $projectID;

        return $this;
    }

    /**
     * Get userID
     *
     * @return int
     */
    public function getProjectID()
    {
        return $this->projectID;
    }


    /**
     * Set funding
     *
     * @param float $funding
     *
     * @return Funding
     */
    public function setFunding($funding)
    {
        $this->funding = $funding;

        return $this;
    }

    /**
     * Get funding
     *
     * @return float
     */
    public function getFunding()
    {
        return $this->funding;
    }

}