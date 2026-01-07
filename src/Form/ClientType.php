<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\{
    TextType,
    SubmitType,          // le type du bouton "Enregistrer"
    EmailType,           // optionnel : plus sémantique que TextType pour l'email
};
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(min: 6),
                ],
                'label' => 'Nom complet',
                // Optionnel : ajouter un placeholder
                'attr' => ['placeholder' => 'Au moins 6 caractères'],
            ])

            ->add('mail', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
                'label' => 'Adresse e‑mail',
                'attr' => ['placeholder' => 'exemple@domaine.com'],
            ])

            // bouton d’envoi
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
