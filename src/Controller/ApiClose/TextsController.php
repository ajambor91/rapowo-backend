<?php
namespace App\Controller\ApiClose;

use App\Controller\BaseController;
use App\Entity\Comments;
use App\Entity\Texts;

use App\Repository\UserRepository;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/api/texts")
 */
class TextsController extends BaseController {


    /**
     * @Route("/add-text", methods="POST")
     */
    public function addText(UserRepository $userRepository, Request $request){
        $text = new Texts();

        $postData = $this->getJSONContent();
//        $user = $this->getCurrentUser($request);
        $user = $userRepository ->findOneBy(['id'=>1]);
        $text->setAuthor($user)
            ->setContent($postData['content'])
            ->setRating(0)
            ->setTitle($postData['title']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($text);
        $em->flush();

        return new JsonResponse(["status"=>true,"id"=>$text->getId()],200);
    }

    /**
     * @Route("/edit/{id}", methods="POST")
     */
    public function editText(Texts $texts, int $id){
        $postData = $this->getJSONContent();
        $texts->setContent($postData['content'])
                ->setTitle($postData['title']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($texts);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }
    /**
     * @Route("/remove/{id}")
     */
    public function removeText(Texts $texts, int $id){
        $em = $this->getDoctrine()->getManager();
        $em->remove($texts);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

    /**
     * @Route("/add-comment/{id}", methods="POST")
     */
    public function addComment(Texts $texts, Request $request, int $id){
        $postData = $this->getJSONContent();
        $author = $this->getCurrentUser($request);
        $comment = new Comments();
        $comment->setTitle($postData['title'])
            ->setRating(0)
            ->setText($texts)
            ->setAuthor($author)
            ->setContent($postData['content']);
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

    /**
     * @Route("/editComment/{id}", methods="POST")
     */
    public function editComment(int $id, Comments $comments){
        $em = $this->getDoctrine()->getManager();
        $postData = $this->getJSONContent();
        $comments->setTitle($postData['title'])
                    ->setContent($postData['content']);
        $em->persist($comments);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

    /**
     * @Route("/delete-comment/{id}", methods="GET")
     */
    public function deleteComment(int $id, Comments $comments){

        $em = $this->getDoctrine()->getManager();
        $em->remove($comments);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

    /**
     * @Route("/set-text-rating/{id}", methods="POST")
     */
    public function setTextRating(int $id, Texts $texts){
        $postData = $this->getJSONContent();
        $rating = $postData['note'] == 1 ? $texts->getRating() + 1 : $texts->getRating() - 1;
        $texts->setRating($rating);
        $em = $this->getDoctrine()->getManager();
        $em->persist($texts);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

    /**
     * @Route("/set-comment-rating/{id}", methods="POST")
     */
    public function setCommentRating(int $id, Comments $comments){
        $postData = $this->getJSONContent();
        $em=$this->getDoctrine()->getManager();
        $rating = $postData['note'] == 1 ? $comments->getRating() + 1 : $comments->getRating()-1;
        $comments->setRating($rating);
        $em->persist($comments);
        $em->flush();
        return new JsonResponse(["status"=>"ok"],200);
    }

}
