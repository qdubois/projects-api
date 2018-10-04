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
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;


class APIController
{

    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @Route("/api/projects", name="projects_list")
     *
     */
    public function projectsListAction(EntityManagerInterface $entityManager, Request $request)
    {
        $projects = $entityManager->getRepository(Project::class)->findAll();
        //$data = $this->get('jms_serializer')->serialize($projects, 'json');
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $data = $serializer->serialize($projects, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

}