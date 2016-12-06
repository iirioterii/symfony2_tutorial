<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
            ->add('email', EmailType::class, [
                'required' => false,
                'label' => 'Email Address'
            ])
            ->add('plainPassword', RepeatedType::class, ['type' => PasswordType::class])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UserBundle\Entity\User',
        ]);
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        $view['email']->vars['help'] = 'Hint: It will have an @ symbol';
        $view['username']->vars['help'] = 'Hint: Choose a unique and clever username';

    }


    public function getBlockPrefix()
    {
        return 'user_register_form';
    }
}
