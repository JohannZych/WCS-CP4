<?php

namespace App\Form;

use App\Entity\Candidacy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidacyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameEntreprise', TextareaType::class, ['label' => 'Entreprise :'
            ])
            ->add('content', TextareaType::class, ['label' => 'Commentaires :'
            ])
            ->add('url', TextType::class, ['label' => 'Url :'
            ])
            ->add('gonnaApply', CheckboxType::class, ['label' => 'Je vais postuler', 'required' => false
            ])
            ->add('apply', CheckboxType::class, ['label' => 'J\'ai postulé', 'required' => false
            ])
            ->add('called', CheckboxType::class, ['label' => 'J\'ai eu un appel', 'required' => false
            ])
            ->add('interview', CheckboxType::class, ['label' => 'J\'ai eu un entretien', 'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidacy::class,
        ]);
    }
}
