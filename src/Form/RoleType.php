<?php

namespace App\Form;

use App\Entity\Role;
use App\Entity\Permission;
use App\Entity\RolePermission;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoleType extends AbstractType
{
    public function __construct(private EntityManagerInterface $em) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('permissions', EntityType::class, [
                'class' => Permission::class,
                'choice_label' => 'code',
                'multiple' => true,
                'mapped' => false,
                'data' => array_map(
                    fn($rp) => $rp->getPermission(),
                    $options['data']->getRolePermissions()->toArray()
                ),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Role::class,
        ]);
    }
}
