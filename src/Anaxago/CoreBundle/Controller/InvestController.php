<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Controller;

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
     *
     * @return Response
     */
    public function investAction(EntityManagerInterface $entityManager, Request $request): Response
    {

        $projectName = $request->query->get('projectname');
        $investForm = $this->createForm(InvestType::class, null ,array(
            'data' => array('project-name' => $projectName)
        ));


        return $this->render('@AnaxagoCore/invest.html.twig', ['form' => $investForm->createView()]);

    }
}
