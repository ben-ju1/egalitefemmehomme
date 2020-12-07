<?php

namespace App\Form;

use App\Entity\Piano;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Form\FormTypeInterface;

class PianoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('note', TextType::class, [
                'label' => 'The note you want to add',
                'attr' => [
                    'placeholder' => 'C, D, Bb, G#m...',
                ]
            ])
            ->add('image', UploadedFile::class, [
                'mapped' => false,
                'label' => '',
                'required' => false,
                'constraints' => [
                    new Image([
                        'mimeTypesMessage' => "Please select a valid mime type"
                    ])
                ]
            ])
            ->add('sound', UploadedFile::class, [
                'mapped' => false,
                'label' => '',
                'required' => false,
            ])
            ->add('alternativeNote', TextType::class, [
                'label' => 'The note you added for french notation'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Piano::class,
            'attr' => [

            ]
        ]);
    }
}
