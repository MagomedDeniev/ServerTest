<?php

namespace App\Form;

use App\Entity\User;
use App\Validator\Constraints\Gender;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Имя пользователя'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Почта'
            ])
            ->add('first_name', TextType::class, [
                'label' => 'Имя'
            ])
            ->add('last_name', TextType::class, [
                'label' => 'Фамилия'
            ])
            ->add('middle_name', TextType::class, [
                'label' => 'Отчество'
            ])
            ->add('date_of_birth', DateType::class,[
                'label' => 'Дата рождения',
                'widget' => 'single_text'
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'Пол',
                'choices' => [
                    '-' => 'null',
                    'Мужской' => 'male',
                    'Женский' => 'female',
                ],
                'constraints' => [
                    new Gender([
                        'message' => 'Неправильный тип аккаунта'
                    ])
                ]
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Телефон'
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
