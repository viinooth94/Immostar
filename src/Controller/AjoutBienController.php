<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Bien;
use App\Form\BienType;

class AjoutBienController extends AbstractController
{
    /**
     * @Route("/ajout", name="ajout_bien")
     */
    public function index()
    {
        return $this->render('ajout_bien/Produit.html.twig');
    }
    
    /**
     * @Route("/bien", name="_bien")
     */
    public function AjoutBien(Request $query){
        
        $bien = new Bien() ;
        
        $form = $this->createForm(BienType::class, $bien);
        
        $form->handleRequest($query);
        
        if($query->isMethod('POST')) {
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($bien);
                $entityManager->flush() ;
                //$query->getSession()->getFlashBag()->add('notice','Categorie Enregistrée.');
                
                return $this->redirectToRoute('Afficher_bien');
            }
        }
        return $this->render('ajout_bien/AjoutBien.html.twig',array('form'=> $form->createView(),));
    }
    /**
     * @Route("/Afficher_bien", name="Afficher_bien")
     */
    public function AfficherBien(){
        $em = $this->getDoctrine()->getManager();
 
        $unBien = $em->getRepository(Bien::class)->findAll();
        
        return $this->render('ajout_bien/Produit.html.twig', array('bien' => $unBien));
        
    }
    
    /**
     * @Route("/RechercheParBien", name="RechercheParBien")
     */
    public function RechercheParBien($id){
        $qb = $this->_em->createQueryBuilder('b');
        
        $qb->select('b')
                ->from(Bien::class,'b')
                ->innerJoin(Type::class,'t','WITH','t.id=b.type')
                ->where('t.id=:id')
                ->setParametre('id',$id);
        $query = $qb ->getQuery();
        $result = $query ->getResult();
        
        return $result ;
    }
    
}
