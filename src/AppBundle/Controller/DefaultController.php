<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Form\ProductType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     *
     * @return RedirectResponse
     */
    public function indexAction()
    {
        return $this->redirectToRoute('products_index');
    }

    /// Products ///////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/products", name="products_index")
     * @Template("@App/Product/index.html.twig")
     *
     * @param Request $request
     *
     * @return array
     */
    public function productsIndexAction(Request $request)
    {
        $categoryId = $request->query->getInt('categoryId');
        $page = $request->query->getInt('page', 1);

        $products = $this->get('app.product_service')->findAll($categoryId, $page);
        $categories = $this->get('app.product_service')->findAllCategories();

        return compact('categoryId', 'products', 'categories');
    }

    /**
     * @Route("/products/{id}", name="products_view", requirements={ "id": "\d+" })
     * @ParamConverter("product", class="AppBundle:Product")
     * @Template("@App/Product/view.html.twig")
     *
     * @param Product $product
     *
     * @return array
     */
    public function productsViewAction(Product $product)
    {
        return compact('product');
    }

    /**
     * @Route("/products/create", name="products_create")
     * @Template("@App/Product/create.html.twig")
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function productsCreateAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product, [
            'uploadsPath' => $this->getParameter('uploads_path'),
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted())
            if ($form->isValid()) {
                $this->get('app.product_service')->save($product);
                $this->addFlash('success', 'app.common.flashes.success');
                return $this->redirectToRoute('products_index');
            } else {
                $this->addFlash('error', 'app.common.flashes.error');
            }

        return [
            'form' => $form->createView(),
        ];
    }

    /// Orders /////////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @Route("/orders/current", name="orders_current")
     * @Template("@App/Order/current.html.twig")
     *
     * @Security("has_role('ROLE_USER')") 
     *
     * @return array
     */
    public function ordersCurrentAction()
    {
        $order = $this->get('app.order_service')->current();

        return compact('order');
    }

    /**
     * @Route("/orders/add/{productId}", name="orders_add", requirements={ "id": "\d+" })
     * @Method("POST")
     * @ParamConverter("product", class="AppBundle:Product", options={
     *     "mapping": { "productId": "id" }
     * })
     *
     * @Security("has_role('ROLE_USER')") 
     *
     * @param Product $product
     *
     * @return RedirectResponse
     */
    public function ordersAddAction(Product $product)
    {
        $this->get('app.order_service')->addProduct($product);
        $this->addFlash('success', 'app.common.flashes.success');

        return $this->redirectToRoute('orders_current');
    }

    /**
     * @Route("/orders/submit", name="orders_submit")
     * @Method("POST")
     *
     * @Security("has_role('ROLE_USER')") 
     *
     * @return RedirectResponse
     */
    public function ordersSubmit()
    {
        $this->get('app.order_service')->submit();
        $this->addFlash('success', 'app.common.flashes.success');

        return $this->redirectToRoute('default');
    }

    /**
     * @Route("/orders/my", name="orders_my")
     * @Template("@App/Order/my.html.twig")
     *
     * @Security("has_role('ROLE_USER')")
     *
     * @param Request $request
     *
     * @return array
     */
    public function ordersMyAction(Request $request)
    {
        $page = $request->query->getInt('page', 1);
        $orderItems = $this->get('app.order_service')->my($page);

        return compact('orderItems');
    }
}
