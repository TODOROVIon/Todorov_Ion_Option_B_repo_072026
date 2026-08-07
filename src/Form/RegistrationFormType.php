<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastName',TextType::class,[
                'label'=>'Nom',
                'constraints'=>[
                    new NotBlank([
                    'message'=>"Nom obligatoire, si non, je t'es retrouve"
                    ])
                ]
            ])
            ->add('firstName',TextType::class,[
                'label'=>'Prenom',
                'constraints'=>[
                    new NotBlank([
                    'message'=>"Prenom obligatoire, si non, je t'es retrouve"
                    ])
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=>'Email',
                'constraints'=>[
                    new NotBlank([
                        'message'=>"Email obligatoire, si non, je t'es retrouve"
                    ])
                ]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'=>PasswordType::class,
                'mapped' => false,
                'first_options'=>[
                    'label'=>'Mot de passe',
                ],
                'second_options'=>[
                    'label'=>'Confirmation mot de passe',
                ],
                'constraints' => [
                    new NotBlank(
                        message: 'Entrer votre mot de passe',
                    ),
                    new Length(
                        min: 4,
                        minMessage: 'Your password should be at least {{ limit }} characters',
                        max: 4096,
                    ),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label'=>"J'accepte les CGU de GreenGoodies",
                'mapped' => false,
                'constraints' => [
                    new IsTrue(
                        message: "Label obligatoire, si non, je t'es retrouve",
                    ),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
