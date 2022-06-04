<?php

namespace App\Factory;

use App\Entity\Account;
use App\Entity\Notification;
use App\Repository\NotificationRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Notification>
 *
 * @method static Notification|Proxy createOne(array $attributes = [])
 * @method static Notification[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Notification|Proxy find(object|array|mixed $criteria)
 * @method static Notification|Proxy findOrCreate(array $attributes)
 * @method static Notification|Proxy first(string $sortedField = 'id')
 * @method static Notification|Proxy last(string $sortedField = 'id')
 * @method static Notification|Proxy random(array $attributes = [])
 * @method static Notification|Proxy randomOrCreate(array $attributes = [])
 * @method static Notification[]|Proxy[] all()
 * @method static Notification[]|Proxy[] findBy(array $attributes)
 * @method static Notification[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Notification[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static NotificationRepository|RepositoryProxy repository()
 * @method Notification|Proxy create(array|callable $attributes = [])
 */
final class NotificationFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    public  function addPost( Account  $account):self
    {
        return $this->addState(['post' => PostFactory::random(['account' => $account])]);
    }

    protected function getDefaults(): array
    {
        return [
            'IsSeen' => self::faker()->boolean(),
            'account' => AccountFactory::random(),

        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Notification $notification): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Notification::class;
    }
}
