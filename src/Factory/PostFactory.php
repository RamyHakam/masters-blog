<?php

namespace App\Factory;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Service\UploadFileService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Post>
 *
 * @method static Post|Proxy createOne(array $attributes = [])
 * @method static Post[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Post|Proxy find(object|array|mixed $criteria)
 * @method static Post|Proxy findOrCreate(array $attributes)
 * @method static Post|Proxy first(string $sortedField = 'id')
 * @method static Post|Proxy last(string $sortedField = 'id')
 * @method static Post|Proxy random(array $attributes = [])
 * @method static Post|Proxy randomOrCreate(array $attributes = [])
 * @method static Post[]|Proxy[] all()
 * @method static Post[]|Proxy[] findBy(array $attributes)
 * @method static Post[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Post[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static PostRepository|RepositoryProxy repository()
 * @method Post|Proxy create(array|callable $attributes = [])
 */
final class PostFactory extends ModelFactory
{
    const  defaultPhotos = [
        'post1.webp',
        'post2.jpeg',
        'post3.jpg',
        'post5.jpeg',
        'post6.jpeg',
        'post7.webp',
    ] ;
    private UploadFileService $uploadFileService;

    public function __construct(UploadFileService  $uploadFileService)
    {
        parent::__construct();
        $this->uploadFileService = $uploadFileService;
    }

    public function withPhoto()
    {
        return $this->addState(['photo' => $this->fakeUploadPostPhoto(),'text' => self::faker()->sentence]) ;
    }

    protected function getDefaults(): array
    {
        return [
            'likes' => self::faker()->randomNumber(3),
            'text' => self::faker()->text,
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Post $post): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Post::class;
    }

    private  function fakeUploadPostPhoto(): string
    {
        $avatar = self::faker()->randomElement(self::defaultPhotos);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir() . '/' . $avatar;
        $fs->copy(__DIR__ . '/images/posts/' . $avatar , $targetPath);
        return $this->uploadFileService->upload(new File($targetPath), UploadFileService::PostType);
    }
}
