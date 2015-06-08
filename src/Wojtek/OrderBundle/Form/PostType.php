<?php

namespace Wojtek\OrderBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('userLogin')
                ->add('item')
                ->add('userPaid', 'checkbox', array(
                    'required' => false,
                ))
                ->add('datePayment', 'date', array(
                    'format' => 'dMy',
                ))
                ->add('dateOrder', 'date', array(
                    'format' => 'dMy',
                ))
                ->add('orderId')
                ->add('priceShipping')
                ->add('orderPrice')
                ->add('trackingNumber')
                ->add('otherData', 'textarea', array(
                    'required' => false
                ))
                ->add('commission')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Wojtek\OrderBundle\Entity\Post'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'wojtek_orderbundle_post';
    }

}
