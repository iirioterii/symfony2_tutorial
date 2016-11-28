<?php

namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', 'text')
            ->add('email', 'email', [
                'required' => false,
                'label' => 'Email Address'
            ])
            ->add('plainPassword', 'repeated', ['type' => 'password'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UserBundle\Entity\User',
        ]);
    }

    public function getName()
    {
        return 'user_bundle_register_form_type';
    }
}
