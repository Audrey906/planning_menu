<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('old_password', PasswordType::class, [
            'label' => "Mot de passe actuel",
            'mapped' => false,  
        ] )
        ->add('new_password', RepeatedType::class, [
            'type' => PasswordType::class,
            'invalid_message' => "Le mot de passe et la confirmation doivent être identiques",
            'label'=> "Nouveau mot de passe",
            'required' => true,
            'mapped' => false,
            // 'constraints' => [
            //     new NotBlank([
            //         'message' => 'Vous devez entrer un mot de passe',
            //     ]),
            //     new Length([
            //         'min' => 6,
            //         'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
            //         // max length allowed by Symfony for security reasons
            //         'max' => 4096,
            //     ]),
            // ],
            "first_options" => [
                "label" => "Nouveau mot de passe",
            ],
            "second_options" => [
                "label" => "Confirmer le mot de passe",
            ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
