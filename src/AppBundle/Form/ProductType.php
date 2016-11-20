<?php

namespace AppBundle\Form;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('photo', FileType::class, [
                'label' => 'app.product.entity.image',
                'constraints' => [
                    new Image(),
                    new NotBlank(),
                ],
            ])
            ->add('title', TextType::class, [
                'label' => 'app.product.entity.name',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'app.product.entity.description',
            ])
            ->add('price', NumberType::class, [
                'label' => 'app.product.entity.price',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('categories', EntityType::class, [
                'class' => ProductCategory::class,
                'label' => 'app.product.entity.category',
                'choice_label' => 'title',
                'expanded' => true,
                'multiple' => true,
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) use ($options) {

                /** @var Product $product */
                $product = $event->getData();

                /** @var UploadedFile $file */
                $file = $product->getPhoto();

                $randomFilename = md5(uniqid()) . '.' . $file->guessClientExtension();
                $file->move($options['uploadsPath'], $randomFilename);
                $product->setPhoto($randomFilename);
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
        $resolver->setRequired([
            'uploadsPath',
        ]);
    }
}
