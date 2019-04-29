<?php
namespace App\Controller\ApiClose;
use App\Controller\BaseController;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/api/user", methods="POST")
 */
class UserController extends BaseController
{

    /**
     * @param UserRepository $userRepository
     * @param Request $request
     * @return JsonResponse
     * @Route("/edit/{id}", methods="POST")
     */
    public function editProfile(UserRepository $userRepository, Request $request)
    {
        $postData = $this->getJSONContent();
        $user = $this->getCurrentUser($request);
        if ($postData['plainPassword'] != null) {
            $user = $userRepository->newPassword($user, $postData['plainPassword']);
        }


        $user->setAge(isset($postData['age']) == true ? $postData['age'] : null)
            ->setCity(isset($postData['city']) == true ? $postData['city'] : null)
            ->setSex(isset($postData['sex']) == true ? $postData['sex'] : null)
            ->setName(isset($postData['name']) == true ? $postData['name'] : null)
            ->setEmail(isset($postData['email']) == true ? $postData['email'] : null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return new JsonResponse(["status" => "ok"], 200);
    }
}
