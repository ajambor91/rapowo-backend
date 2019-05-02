<?php
namespace App\Controller\Security;


use App\Controller\BaseController;
use App\Entity\User;
use App\Entity\UserImage;
use App\Entity\UserImages;
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
        try {
            $imagePath = $this->handleFile($postData['image'],$postData['email'], $userRepository);
            $image = new UserImage();
            $image->setPath($imagePath)
                    ->setUser($user);

            $user->setEmail($postData['email'])
                ->setNick($postData['nick'])
                ->setRating(0)
                ->addUserImage($image)
                ->setAvatar($image);

            $user = $userRepository->registerUser($user, array('ROLE_USER'), $postData['plainPassword']);

            //$this->sendRegisterMessage($user);

            return new JsonResponse(['status' => 'ok'], 200);
        }
        catch (\Exception $e){
            dump($e);die;
            return new JsonResponse(['status'=>false, 'error'=>'exists'],500);
        }
    }

    /**
     * @Route("/check-email", methods="POST")
     */
    public function checkEmail(UserRepository $userRepository){
        $postData = $this->getJSONContent();
        $user = $userRepository->findOneBy(['email'=>$postData['email']]);
        if($user){
            return new JsonResponse(['status'=>false, 'error'=>"Email jest już zajęty!"], 200);
        }else{
            return new JsonResponse(['status' => true],200);
        }
    }
    /**
     * @Route("/check-nick", methods="POST")
     */
    public function checkNick(UserRepository $userRepository){
        $postData = $this->getJSONContent();
        $user = $userRepository->findOneBy(['nick'=>$postData['nick']]);
        if($user){
            return new JsonResponse(['status'=>false, 'error' => 'Nick został już wykorzystany!'], 200);
        }else{
            return new JsonResponse(['status' => true,'errors'],200);
        }
    }
    /**
     * @Route("/check-password", methods="POST")
     */
    public function checkPassword(){
        $postData = $this->getJSONContent();
        $pattern = '(?i)^(?=.*[a-z])(?=.*\d).{6,}$';
        $success = preg_match($pattern, $postData['plainPassword'] );
        if($success){
            return new JsonResponse(['status'=>false], 200);
        }else{
            return new JsonResponse(['status' => true],200);
        }
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

            return new JsonResponse(['status' => true, 'token' => $token, 'user' => [
                'id' =>$userFromDatabase->getId(),
                'nick'=>$userFromDatabase->getNick(),
                'email'=>$userFromDatabase->getEmail()
            ]]);

        } else {
            return new JsonResponse(['status' => false, 'message' => 'wrong_email_or_password'], 401);
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
