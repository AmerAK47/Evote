<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;




class RegisterFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'الاسم',
            ])
            ->add('prenom', TextType::class, [
                'label' => 'اللقب',
            ])
            ->add('email', EmailType::class, [
                'label' => 'الامايل متاعك',
            ])
            ->add('cin', TextType::class, [
                'label' => 'نومرو بطاقة تعريف',
                'attr' => [
                    'oninput' => 'validateCIN(this)',
                    
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'label' => 'الجنس',
                'choices' => [
                    'ذكر' => 'male',
                    'أنثى' => 'female',
                ],
                'expanded' => true,
                'multiple' => false,
                'label_attr' => ['class' => 'form-check-label'],
            ])
            
            
            ->add('resident', ChoiceType::class, [
                'label' => 'هل أنت متغرب؟',
                'choices' => [
                    'نعم' => 'Oui',
                    'لا' => 'Non',
                ],
                
            ])
            ->add('city', ChoiceType::class, [
                'label' => 'وين تسكن؟',
                'choices' => [
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Ben Arous' => 'Ben Arous',
                    'Manouba' => 'Manouba',
                    'Nabeul' => 'Nabeul',
                    'Zaghouan' => 'Zaghouan',
                    'Bizerte' => 'Bizerte',
                    'Béja' => 'Béja',
                    'Jendouba' => 'Jendouba',
                    'Kef' => 'Kef',
                    'Siliana' => 'Siliana',
                    'Kairouan' => 'Kairouan',
                    'Kasserine' => 'Kasserine',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Sousse' => 'Sousse',
                    'Monastir' => 'Monastir',
                    'Mahdia' => 'Mahdia',
                    'Sfax' => 'Sfax',
                    'Kebili'=> 'Kebili',
                    'Gabès' => 'Gabès',
                    'Medenine' => 'Medenine',
                    'Tataouine' => 'Tataouine',
                    'Gafsa' => 'Gafsa',
                    'Tozeur' => 'Tozeur',
                ],
            ]);
            
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
