<?php

namespace App\Form;

use App\Entity\Dish;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DishType extends AbstractType
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
            ->add('dish_name')
            ->add('category', ChoiceType::class, [
                'choices' => [$this->getParents()],
             ])
        ;
    }

    public function getParents(): array
    {
        $er = $this->em->getRepository('App\Entity\Category');
        $results = $er->createQueryBuilder('c')
               ->where('c.category_visible = 1')
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
            'data_class' => Dish::class,
        ]);
    }
}
