<?phpnamespace App\Controller;use App\Entity\Post;use App\Service\AccountDataService;use App\Service\PostService;use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;use Symfony\Component\HttpFoundation\Request;use Symfony\Component\HttpFoundation\Response;use Symfony\Component\Routing\Annotation\Route;class CommentController extends  AbstractController{    private AccountDataService $accountDataService;    private PostService $postService;    public function __construct(AccountDataService $accountDataService,PostService  $postService)    {        $this->accountDataService = $accountDataService;        $this->postService = $postService;    }    /**     * @Route("/comment/{id}", name="add_comment", methods={"POST"})     * @return Response     */    public function addCommentAction(Post $post, Request  $request)    {        $user = $this->accountDataService->getUserData();        $commentText = $request->request->get('commentText');       $comment =   $this->postService->commentOnPost($post, $user, $commentText);        if ($request->isXmlHttpRequest())        {            return  $this->render('wrapper_comment.html.twig',['comment' => $comment]);        }        else {            return $this->redirectToRoute('home_page');        }    }}