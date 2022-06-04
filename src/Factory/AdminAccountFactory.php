<?php

namespace App\Factory;

use App\Entity\AdminAccount;
use App\Repository\AdminAccountRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<AdminAccount>
 *
 * @method static AdminAccount|Proxy createOne(array $attributes = [])
 * @method static AdminAccount[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static AdminAccount|Proxy find(object|array|mixed $criteria)
 * @method static AdminAccount|Proxy findOrCreate(array $attributes)
 * @method static AdminAccount|Proxy first(string $sortedField = 'id')
 * @method static AdminAccount|Proxy last(string $sortedField = 'id')
 * @method static AdminAccount|Proxy random(array $attributes = [])
 * @method static AdminAccount|Proxy randomOrCreate(array $attributes = [])
 * @method static AdminAccount[]|Proxy[] all()
 * @method static AdminAccount[]|Proxy[] findBy(array $attributes)
 * @method static AdminAccount[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static AdminAccount[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static AdminAccountRepository|RepositoryProxy repository()
 * @method AdminAccount|Proxy create(array|callable $attributes = [])
 */
final class AdminAccountFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'email' => self::faker()->text(),
            'password' => self::faker()->text(),
            'firstName' => self::faker()->text(),
            'lastName' => self::faker()->text(),
            'AdminRole' => self::faker()->randomElement([AdminAccount::ROLE_ADMIN, AdminAccount::ROLE_SUPER_ADMIN]),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(AdminAccount $adminAccount): void {})
        ;
    }

    protected static function getClass(): string
    {
        return AdminAccount::class;
    }
}
