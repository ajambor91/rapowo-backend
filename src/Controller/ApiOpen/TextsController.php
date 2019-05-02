<?php
namespace App\Controller\ApiOpen;
use App\Controller\BaseController;
use App\Entity\Texts;
use App\Entity\User;
use App\Repository\TextsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
/**
 * Created by PhpStorm.
 * User: Dukov
 * Date: 03.04.2019
 * Time: 20:27
 */

/**
 * @Route("/texts")
 */
class TextsController extends BaseController{
    /**
     * @Route("/get")
     */
    public function getTexts(TextsRepository $textsRepository){
        $texts = $textsRepository->findAll();
        $dataArray =[];
        foreach ($texts as $text){
            $rating = $text->getRating();
            $ratingClass = ($rating >= 0 ? 'aboveZero' : 'underZero');
            $data = [];
            $author = $text->getAuthor();
            $data['id'] = $text->getId();
            $data['title'] = $text->getTitle();
            $data['content'] = $text->getContent();
            $data['created_at'] = $text->getCreatedAt();
            $data['updated_at'] = $text->getUpdatedAt();
            $data['rating']['note'] = $rating;
            $data['rating']['class'] = $ratingClass;
            $data['author']['id'] = $author->getId();
            $data['author']['nick'] = $author->getNick();
            $data['author']['image'] = $author->getCity();
            $data['author']['rating'] = $author->getRating();
            $data['author']['sex'] = User::SEXES[$author->getSex()];
            $data['author']['city'] = $author->getCity();
            $dataArray[] = $data;
        }

        return new JsonResponse($dataArray,200);
    }
    /**
     * @Route("/get-text/{id}")
     */
    public function getText(int $id, Texts $texts){
        $dataArray = [];
        foreach ($texts as $text){
            /**
             * @var Texts $text
             */
            $dataArray['id'] = $text->getId();
            $dataArray['title'] = $text->getTitle();
            $dataArray['content'] = $text->getContent();
            $dataArray['author'] = $text->getAuthor();
            $dataArray['rating'] = $text->getRating();
            $dataArray['created_at'] = $text->getCreatedAt();
            $dataArray['updated_at'] = $text->getUpdatedAt();
            $dataArray['comments'] = $text->getComments();
        }
        return new JsonResponse(["status"=>"ok", "data"=> $dataArray],200);
    }
}
