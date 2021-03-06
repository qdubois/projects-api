<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

use Anaxago\CoreBundle\Entity\Funding;
use Anaxago\CoreBundle\Entity\User;
use Anaxago\CoreBundle\Form\Type\InvestType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * Class InvestController
 *
 * @package Anaxago\CoreBundle\Controller
 */
class InvestController extends Controller
{
    /**
     * @param EntityManagerInterface $entityManager
     * @param Request $request
     *
     * @return Response
     */
    public function investAction(EntityManagerInterface $entityManager, Request $request): Response
    {
        $newFunding = new Funding();
        $projectName = $request->query->get('projectname');
        $projectID = $request->query->get('projectID');
        $investForm = $this->createForm(InvestType::class, null ,array(
            'data' => array('project-name' => $projectName, 'user' => $this->getUser())
        ));

        $investForm->handleRequest($request);
        if ($investForm->isSubmitted() && $investForm->isValid()) {
            $funding = $investForm->getData()['funding'];
            $newFunding->setProjectID($projectID);
            $newFunding->setUserID($this->getUser()->getID());
            $newFunding->setFunding($funding);
            /*$data = $investForm->getData()['funding'];
            var_dump($data);*/
            $entityManager->persist($newFunding);
            $entityManager->flush();
            return $this->redirectToRoute('anaxago_core_homepage');

        }


        return $this->render('@AnaxagoCore/invest.html.twig', ['form' => $investForm->createView()]);


    }
}
