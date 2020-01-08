<?php

namespace AlbumBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Title:'])
            ->add('artist', TextType::class, ['label' => 'Artist:'])
            ->add('isrc', TextType::class, ['label' => 'ISRC:'])
            ->add('image', FileType::class, [
                'label' => 'Image Upload',
                'required' => false,
            ])
            ->add('trackList', TextareaType::class, [
                'label' => 'Track List:'
            ])
            ->add('submit', SubmitType::class);

        $builder->get('trackList')->addModelTransformer(new CallbackTransformer(
            function ($tracksAsArray) {

            },
            function ($tracksAsString) {
                return explode(',', $tracksAsString);
            }
        ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AlbumBundle\Entity\Album'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'albumbundle_album';
    }


}
