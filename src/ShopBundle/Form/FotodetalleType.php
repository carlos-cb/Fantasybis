<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Doctrine\ORM\EntityRepository;

class FotodetalleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->traitChoices = $options['trait_choices'];

        $builder
            ->add('color', null, array(
                'label' => '所属颜色',
                'choices' => $this->traitChoices,
                'class' => 'ShopBundle:Color',
                'property' => 'colorNameEs',
                'required' => true,
            ))
            ->add('fotodetalle', FileType::class, array(
                'data_class' => null,
                'required' => false,
            ))
            ->add('descriptionEs', null, array('label' => '描述西语'))
            ->add('descriptionEn', null, array('label' => '描述英语'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Fotodetalle',
            'trait_choices' => null,
        ));
    }
}
