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
    public function investAction(EntityManagerInterface $entityManager): Response
    {

        $investForm = $this->createForm(InvestType::class);
       // $investForm->add('S\'enregistrer', SubmitType::class);

       /* $registrationForm->handleRequest($request);
        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $em->persist($newUser);
            $em->flush();

            // login user after its registration
            $usernameToken = new UsernamePasswordToken($newUser, $newUser->getPassword(), 'main', $newUser->getRoles());
            $tokenStorage->setToken($usernameToken);
            $session->set('_security_main', serialize($usernameToken));

            return $this->redirectToRoute('anaxago_core_homepage');
        }*/

        return $this->render('@AnaxagoCore/invest.html.twig', ['form' => $investForm->createView()]);

    }
}
