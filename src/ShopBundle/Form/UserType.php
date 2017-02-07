<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array('label' => '用户名'))
            ->add('email', null, array('label' => '邮箱'))
            ->add('plainPassword', null, array('label' => '密码'))
            ->add('tel', null, array('label' => '联系电话'))
            ->add('companyName', null, array('label' => '公司名称'))
            ->add('companyAddress', null, array('label' => '公司地址'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\User'
        ));
    }
}
