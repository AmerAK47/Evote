<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
//Fedia Amdouni
class LoginController extends AbstractController
{
    /**
     * @Route("/login", name="login", methods={"POST"})
     */
    public function login(Request $request)
    {
        $email = $request->request->get('email');
        $cin = $request->request->get('cin');

        
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy([
                'email' => $email,
                'cin' => $cin,
            ]);

        if ($user) {
            
            if ($email === 'admin@admin' && $cin === '1') {
                return $this->redirectToRoute('admin_home');
            } else {
                return $this->redirectToRoute('user_home');
            }
        } else {
           
            $this->addFlash('error', 'Invalid email or password.');
            return $this->redirectToRoute('login');
        }
    }
}
