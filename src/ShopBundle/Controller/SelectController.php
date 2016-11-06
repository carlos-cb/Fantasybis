<?php

namespace ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ShopBundle\Entity\Product;

class SelectController extends Controller
{
    public function selectNewAction()
    {
        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository('ShopBundle:Category')->findAll();
        $query = $em->createQuery("SELECT p FROM ShopBundle:Product p WHERE p.isNew=1");
        $products = $query->getResult();
        return $this->render('select/new.html.twig', array(
            'products' => $products,
            'categories' => $categories,
        ));
    }

    public function addNewAction(Request $request)
    {
        $codigo = $request->request->get('codigo');
        $repository = $this->getDoctrine()->getRepository('ShopBundle:Product');
        $product = $repository->findOneByCode($codigo);
        if($product){
            if($product->getIsNew()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '该产品已经在新产品列表中。'
                );
            }else{
                $product->setIsNew(true);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '添加成功。'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '不能完成添加，请确认产品编号是否正确。'
            );
        }
        return $this->redirectToRoute('select_new');
    }

    public function deleteNewAction(Product $product)
    {
        if($product){
            if(!$product->getIsNew()){
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    '已经将该产品从新品列表中移除。'
                );
            }else{
                $product->setIsNew(false);
                $em = $this->getDoctrine()->getManager();
                $em->persist($product);
                $em->flush();
                $this->get('session')->getFlashBag()->add(
                    'success',
                    '移除成功。'
                );
            }
        }else{
            $this->get('session')->getFlashBag()->add(
                'notice',
                '不能添加，请刷新网页后重试。'
            );
        }
        return $this->redirectToRoute('select_new');
    }
}
