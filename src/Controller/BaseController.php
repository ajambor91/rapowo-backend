<?php
namespace App\Controller;
use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class BaseController extends Controller {
    /**
     * jwtAuth field
     *
     * @var JWTEncoderInterface
     */
    protected $jwtAuth;

    /**
     * ApiController constructor.
     * @param JWTEncoderInterface $jwtAuth
     */
    public function __construct(JWTEncoderInterface $jwtAuth)
    {
        $this->jwtAuth = $jwtAuth;

    }

    /**
     * Get json
     * @return JSON
     */
    protected function getJSONContent(){
        $request = Request::createFromGlobals();
        return  json_decode($request->getContent(), true);
    }
    protected function getCurrentUser(Request $request){
        $token = $request->headers->get('Authorization');
        $token = str_replace('Bearer ', '', $token);
        $decodedToken = $this->jwtAuth->decode($token);
        $userFromDatabase = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy(['email' => $decodedToken['username']]);
        return $userFromDatabase;
    }
    protected function handleFile($file,$type){

    }
}
