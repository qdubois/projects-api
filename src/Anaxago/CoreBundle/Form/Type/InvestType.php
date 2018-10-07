<?php declare(strict_types = 1);

namespace Anaxago\CoreBundle\Form\Type;

use Anaxago\CoreBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 14/07/18
 * Time: 16:02
 */
class InvestType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $projectName =  $options['data']['project-name'];
        $user =  $options['data']['user'];

        $builder
            ->add('back', ButtonType::class, array('label' => '<--','attr' => array('onClick' => 'window.history.go(-1)')))
            ->add('funding', NumberType::class, array('label' => 'How much do you want to invest in '.$projectName.' ?' ));
            if (!empty($user)){ //test if login
                $builder
                ->add('invest', SubmitType::class, array(
                'attr' => array('class' => 'btn btn-success'),'label' => 'Invest !!'
                ));
            }
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setRequired(array(
            'project-slug'
        ));

    }
}
