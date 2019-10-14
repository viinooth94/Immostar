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
    
    public function AfficherBien(){
        $em = $this->getDoctrine()->getManager();
 
        $unBien = $em->getRepository(Bien::class)->findAll();
        
        return $this->render('ajout_bien/Produit.html.twig', array('bien' => $unBien));
        
    }
    
    /**
      * 
      *@Route("/bien/update/{id}",name="upd_route")
      * 
      */     
     public function updateArticle(Request $request, $id){
         
        $bien = new Bien() ;
        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
        
        //$id = $session->get('login');
        $request->getSession()->getFlashBag()->add('notice', '');
        
        $form = $this->createForm(BienType::class, $bien);
        
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if($form->isValid()){
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                $request->getSession()->getFlashBag()->add('success', 'Article modifié avec succès.');
                return $this->redirectToRoute('Afficher_bien',array('id'=>$id));
            }
        }
        return $this->render( 'ajout_bien/AjoutBien.html.twig', array(
            'form' =>$form->createView(), 'bien'=>$bien));
    }
     
    public function listerBienParType(Request $request, $id) {
       
        $em = $this->getDoctrine()->getManager();
        $type = $em->getRepository(Bien::class)->rechercherParType2($id);    
        return $this->render('ajout_bien/BienParType.html.twig',array('bien'=>$type));
     }
     
    
      /**
      *
      *@Route("/bien/supprimer/{id}",name="del_bien")
      *
      */
    public function deleteBien( $id){

        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($bien);
        $em->flush();
        return $this->redirectToRoute('Afficher_bien');
    }
 
    
}
