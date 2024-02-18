<?php


namespace App\Controller;


use App\Entity\Post;
use App\Form\PostType;
use App\Service\AccountDataService;
use App\Service\PostService;
use App\Service\UploadFileService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends  AbstractController
{
    /**
     * @var PostService
     */
    private PostService  $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    /**
     * @return Response
     */
    #[Route(path: '/home', name: 'home_page')]
    #[Security('is_granted("IS_AUTHENTICATED")')]
    public function Home(Request  $request,UploadFileService  $uploadFileService): Response
    {
        $account = $this->getUser();
        $postForm = $this->createForm(PostType::class,null,['action' => '#']);
        $postForm->handleRequest($request);
        if ($postForm->isSubmitted() && $postForm->isValid()) {
            /** @var Post $post */
            $post = $postForm->getData();
            $postPhoto = $postForm->get('postPhoto')->getData();
            if($postPhoto)
            {
                $postPhotoName = $uploadFileService->upload($postPhoto,UploadFileService::PostType);
                $post->setPhoto($postPhotoName);
            }
            $post->setAccount($account);
            $this->postService->addPost($post);
            $postForm = $this->createForm(PostType::class,null,['action' => '#']);

            if ($request->isXmlHttpRequest())
            {
                return  $this->render('wrapper_post.html.twig',['post' => $post,'account' => $account]);
            }

        }
        $posts = $this->postService->getRecentPosts();


        return $this->render('home.html.twig',['posts'=>$posts,'account'=>$account,'postForm'=>$postForm->createView()]);
    }
}