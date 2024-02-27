<?php


namespace App\Controller;


use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @package App\Controller
 */
#[Security('is_granted("IS_AUTHENTICATED")')]
class PostController extends AbstractController
{
    public function __construct(private PostRepository $postRepository, private EntityManagerInterface $entityManager, private LoggerInterface $logger)
    {
    }

    #[Route(path: '/post/{id}', name: 'single_post', methods: ['GET'])]
    public function getPostAction(int $id): Response
    {
        return $this->render('single_post.html.twig', ['id' => $id]);
    }

    #[Route(path: '/report_post', name: 'report_post', methods: ['POST'])]
    public function reportPostAction(Request $request): Response
    {
        if (!$this->isCsrfTokenValid('report_token', $request->request->get('report_token'))) {
            return new Response('Invalid Token', Response::HTTP_BAD_REQUEST);
        }
        $id = $request->request->get('postId');
        try {
            $post = $this->postRepository->find($id);
            $post->setReported(true);
            $this->entityManager->persist($post);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            $this->logger->error('Error reporting post: ' . $e->getMessage());
            return new JsonResponse(['status' => 'error']);
        }
        return new JsonResponse(['status' => 'reported']);
    }
}