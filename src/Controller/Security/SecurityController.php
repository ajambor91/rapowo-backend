<?php
namespace App\Controller\Security;


use App\Controller\BaseController;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/security")
 */
class SecurityController extends BaseController {
    /**
     * @Route("/register",methods="POST")
     */
    public function registerUser(UserRepository $userRepository){
        $user = new User();
        $postData = $this->getJSONContent();
        $user->setEmail($postData['email'])
            ->setNick($postData['nick'])
            ->setRating(0);
        $user = $userRepository->registerUser($user, array('ROLE_USER'), $postData['plainPassword']);

        $this->sendRegisterMessage($user);


        return new JsonResponse(['status'=>'ok'],200);
    }
    /**
     * @Route("/login",methods="POST")
     */
    public function login(UserPasswordEncoderInterface $passwordEncoder)
    {

        $postData = $this->getJSONContent();
        $userFromDatabase = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email' => $postData['email'],'isActive' => true]);
        if (!$userFromDatabase) {
            return new JsonResponse(["status" => false, "error" => "user not exists"], 404);
        }

        if ($passwordEncoder->isPasswordValid($userFromDatabase, $postData['plainPassword'])) {
            $token = $this->jwtAuth->encode(['username' => $postData['email'], 'exp' => time() + 604800]);
            return new JsonResponse(['status' => 'ok', 'token' => $token, 'message' => '']);
        } else {
            return new JsonResponse(['status' => 'validation', 'message' => 'wrong_email_or_password'], 401);
        }
    }


    /**
     * @Route("/password-recover", methods="POST")
     */
    public function recoverPassword(Request $request){
        $user = $this->getCurrentUser($request);
        $hash = md5($user->getEmail());

    }
    /**
     * @Route("/activation/{hash}",name="activation")
     */
    public function activation($hash, UserRepository $userRepository)
    {
        $activationResult = $userRepository->activation($hash);

        if (!empty($activationResult)) {
            $this->get('session')->getFlashBag()->add('success', 'Twoje konto zostało aktywowane, zaloguj się');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'Niepoprawny link aktywacyjny');
        }

        return new JsonResponse(['status'=>'ok'],200);
    }
    /**
     * @Route("/activation/{hash}",name="activation")
     */
    public function sendRegisterMessage(User $user)
    {


        $message = (new \Swift_Message('Aktywacja konta Rapowo.pl'))
            ->setFrom($this->container->getParameter('sender_mail'))
            ->setTo($user->getEmail())
            ->setBody(
                $this->renderView(
                    'emails/registration.html.twig',
                    array('name' => $user->getName(),
                        'hash' => $user->getHash())
                ),
                'text/html'
            );

        $this->get('mailer')->send($message);
    }
}
