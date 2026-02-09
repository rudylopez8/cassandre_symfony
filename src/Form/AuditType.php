<?php

namespace App\Form;

use App\Entity\Audit;
use App\Entity\AuditReport;
use App\Entity\Company;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AuditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('status')
            ->add('startDate')
            ->add('endDate')
            ->add('scope')
            ->add('notes')
            ->add('createdAt', null, [
                'widget' => 'single_text',
            ])
            ->add('updatedAt')
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'id',
            ])
            ->add('auditReport', EntityType::class, [
                'class' => AuditReport::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Audit::class,
        ]);
    }
}
