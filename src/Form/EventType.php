<?php

namespace App\Form;

use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Place;
use App\Entity\Category;
//use App\Entity\User;




class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            //->add('createdAt')
            ->add('startAt')
            ->add('endAt')
            ->add('content')
            ->add('price')
            ->add('poster')
            ->add('place', EntityType::class, array(
                'class' => Place::class,
                'choice_label' => 'name'))
            ->add('categories', EntityType::class, array(
                'class' => Category::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true))

            // ->add('owner', EntityType::class, array(
            //     'class' => User::class,
            //     'choice_label' => 'username'))           
        ;

    }

   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
