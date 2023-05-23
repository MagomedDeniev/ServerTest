<?php

namespace App\Form;

use App\Entity\User;
use App\Validator\Constraints\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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
            ->add('username',TextType::class, [
                'label' => 'Имя пользователя'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Почта'
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'password.not.same',
                'second_options' => ['label' => 'Подтвердите пароль'],
                'first_options' => [
                    'label' => 'Пароль',
                    'constraints' => [
                        new NotBlank([
                            'message' => 'password.is.empty',
                        ]),
                        new Length([
                            'min' => 6,
                            'max' => 80,
                            'minMessage' => 'password.min.length.message',
                            'maxMessage' => 'password.max.length.message'
                        ]),
                    ],
                    'attr' => [
                        'minlength' => 6,
                        'maxlength' => 80,
                    ]
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'label' => 'Принять пользовательское соглашение',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
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
