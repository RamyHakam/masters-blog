<?php

namespace App\Factory;

use App\Entity\Account;
use App\Repository\AccountRepository;
use App\Service\UploadFileService;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Account>
 *
 * @method static Account|Proxy createOne(array $attributes = [])
 * @method static Account[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Account|Proxy find(object|array|mixed $criteria)
 * @method static Account|Proxy findOrCreate(array $attributes)
 * @method static Account|Proxy first(string $sortedField = 'id')
 * @method static Account|Proxy last(string $sortedField = 'id')
 * @method static Account|Proxy random(array $attributes = [])
 * @method static Account|Proxy randomOrCreate(array $attributes = [])
 * @method static Account[]|Proxy[] all()
 * @method static Account[]|Proxy[] findBy(array $attributes)
 * @method static Account[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Account[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AccountRepository|RepositoryProxy repository()
 * @method Account|Proxy create(array|callable $attributes = [])
 */
final class AccountFactory extends ModelFactory
{
    const  defaultAvatars = [
        'thumbnail1.jpg',
        'thumbnail2.jpg',
        'thumbnail3.jpg',
        'thumbnail4.jpg',
        'thumbnail5.jpg',
    ] ;
    private UploadFileService $uploadFileService;

    public function __construct(UploadFileService  $uploadFileService)
    {
        parent::__construct();
        $this->uploadFileService = $uploadFileService;
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'email' => self::faker()->email,
            'password' => self::faker()->password,
            'firstName' => self::faker()->name,
            'lastName' => self::faker()->name,
            'phone' => self::faker()->phoneNumber(),
            'title' => self::faker()->jobTitle,
            'address' => self::faker()->address(),
            'avatar' => $this->fakeUploadAvatar(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Account $account): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Account::class;
    }

    private  function fakeUploadAvatar(): string
    {
        $avatar = self::faker()->randomElement(self::defaultAvatars);
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir() . '/' . $avatar;
        $fs->copy(__DIR__ . '/images/avatars/' . $avatar , $targetPath);
        return $this->uploadFileService->upload(new File($targetPath), UploadFileService::avatarType);
    }
}
