<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('productNameEs', null, array('label' => '产品西语名'))
            ->add('productNameEn', null, array('label' => '产品英语名'))
            ->add('category', null, array(
                'label' => '所属分类',
                'class' => 'ShopBundle:Category',
                'property' => 'categoryNameEs',
            ))
            ->add('foto', FileType::class, array(
                'data_class' => null,
                'required' => false,
            ))
            ->add('price', null, array('label' => '单价'))
            ->add('code', null, array('label' => '编号'))
            ->add('description', null, array('label' => '备注'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Product'
        ));
    }
}
