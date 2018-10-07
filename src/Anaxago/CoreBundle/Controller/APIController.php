<?php
/**
 * Created by PhpStorm.
 * User: quentindubois
 * Date: 04/10/2018
 * Time: 16:05
 */

namespace Anaxago\CoreBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Anaxago\CoreBundle\Entity\Project;
use Anaxago\CoreBundle\Entity\Funding;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class APIController
{

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @Route("/api/projects", name="projects_list")
     *
     * @return Response $response
     */
    public function projectsListAction(EntityManagerInterface $entityManager, Request $request)
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $data = $serializer->serialize($projects, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @Route("/api/invest", name="invest")
     *
     * @return Response $response
     */
    public function investAPIAction(EntityManagerInterface $entityManager, Request $request)
    {
        $token = $request->request->get('token');
        //if token is empty do not look for authorization
        if (!empty($token)) {
            $rawquery = "SELECT id FROM user where token = '" . $token . "'";
            $qb = $entityManager->getConnection()->prepare($rawquery);
            $qb->execute();
            $userID = $qb->fetchAll();
        }

        //token not found in DB
        if (empty($userID)){
            $array = array('error' => '401', 'message' => 'Unauthorized');
            $response = new Response(json_encode($array), 401);
            $response->headers->set('Content-Type', 'application/json');
        }else{
            $response = new Response($token, 200);

            $funding = $request->request->get('funding');
            $projectID = $request->request->get('projectID');
            if (empty($funding) || empty($projectID)){
                $array = array('error' => '500', 'message' => 'Missing parameters');
                $response = new Response(json_encode($array), 401);
                $response->headers->set('Content-Type', 'application/json');
            }else{
                $fundingToPersist = (new Funding())
                    ->setUserID($userID[0]["id"])
                    ->setProjectID($projectID)
                    ->setFunding($funding);
                $entityManager->persist($fundingToPersist);
                $entityManager->flush();
                $array = array( 'message' => 'Success');
                $response = new Response(json_encode($array), 200);
                $response->headers->set('Content-Type', 'application/json');
            }
        }


        return $response;
    }


    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @Route("/api/userprojects", name="user_projects_list")
     *
     * @throws Unauthorized response if the provided token is invatlid
     *
     * @return Response $response
     */
    public function userProjectListAction(EntityManagerInterface $entityManager, Request $request)
    {
        $token = $request->query->get('token');

        //if token is empty do not look for authorization
        if (!empty($token)) {
            $rawquery = "SELECT id FROM user where token = '" . $token . "'";
            $qb = $entityManager->getConnection()->prepare($rawquery);
            $qb->execute();
            $userID = $qb->fetchAll();
        }

        //token not found in DB
        if (empty($userID)){
            $array = array('error' => '401', 'message' => 'Unauthorized');
            $response = new Response(json_encode($array), 401);
            $response->headers->set('Content-Type', 'application/json');
        }else{
            //Get all the projects for a user with a valid token
            $projects = $entityManager->getRepository(Project::class)->findByUser($userID[0]["id"]);

            $encoders = array(new JsonEncoder());
            $normalizers = array(new ObjectNormalizer());
            $serializer = new Serializer($normalizers, $encoders);
            $data = $serializer->serialize($projects, 'json');

            $response = new Response($data);

        }

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}