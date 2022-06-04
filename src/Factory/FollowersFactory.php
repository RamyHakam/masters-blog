<?php

namespace App\Factory;

use App\Entity\Followers;
use App\Repository\FollowersRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Followers>
 *
 * @method static Followers|Proxy createOne(array $attributes = [])
 * @method static Followers[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Followers|Proxy find(object|array|mixed $criteria)
 * @method static Followers|Proxy findOrCreate(array $attributes)
 * @method static Followers|Proxy first(string $sortedField = 'id')
 * @method static Followers|Proxy last(string $sortedField = 'id')
 * @method static Followers|Proxy random(array $attributes = [])
 * @method static Followers|Proxy randomOrCreate(array $attributes = [])
 * @method static Followers[]|Proxy[] all()
 * @method static Followers[]|Proxy[] findBy(array $attributes)
 * @method static Followers[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Followers[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static FollowersRepository|RepositoryProxy repository()
 * @method Followers|Proxy create(array|callable $attributes = [])
 */
final class FollowersFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            'followed_since' => self::faker()->dateTimeBetween('-1 year', 'now'),
            'followedBy' => AccountFactory::random(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Followers $followers): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Followers::class;
    }
}
