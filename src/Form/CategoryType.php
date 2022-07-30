<?php

namespace App\Form;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category_name')
            ->add('parent', ChoiceType::class, [
               'choices' => [$this->getParents()],
            ])
            ->add('category_visible', ChoiceType::class, [
                'choices' => [
                    'oui' => true,
                    'non' => false,
                ],
            ])
        ;
    }

    public function getParents(): array
    {
        $er = $this->em->getRepository('App\Entity\Category');
        $results = $er->createQueryBuilder('c')
               ->where('c.parent is null')
               ->groupBy('c.id')
               ->orderBy('c.category_name', 'ASC')
               ->getQuery()
               ->getResult();

        $categories['---'] = null;
        foreach ($results as $cat) {
            $categories[$cat->getCategoryName()] = $cat;
        }

        return $categories;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
