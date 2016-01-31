<?php

namespace Runator\TradBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TranslateType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('token')
            ->add('name')
            ->add('language', 'entity', array(
                    'class' => 'RunatorTradBundle:Language',
                    'property' => 'name',
                ))
            ->add('save', 'submit');
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Runator\TradBundle\Entity\Translate',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'runator_tradbundle_translate';
    }
}
