<?php

namespace BabyDressing\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ProfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        	->add('nom', 'text')
        	->add('prenom', 'text')
            ->add('numero', 'text')
            ->add('rue', 'text')
            ->add('codePostal', 'text')
            ->add('ville', 'text')
            ->add('telephone', 'text');
    }

    public function getName()
    {
        return 'user';
    }
}
