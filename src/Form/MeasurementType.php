<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timestamp', DateTimeType::class)
            ->add('temperature')
            ->add('cloudCoverage')
            ->add('humidity')
            ->add('windSpeed')
            ->add('windDirection', ChoiceType::class, [
                'choices' => [
                    'North' => 'N',
                    'North-East' => 'NE',
                    'East' => 'E',
                    'South-East' => 'SE',
                    'South' => 'S',
                    'South-West' => 'SW',
                    'West' => 'W',
                    'North-West' => 'NW'
                ],
            ])
            ->add('pressure')
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'city',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
        ]);
    }
}
