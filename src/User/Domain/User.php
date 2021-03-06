<?php declare(strict_types=1);

namespace SocialNews\User\Domain;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class User
{
    private $id;
    private $nickname;
    private $passwordHash;
    private $creationDate;

    public function __construct(UuidInterface $id, string $nickname, string $passwordHash, DateTimeImmutable $creationDate)
    {
        $this->id = id;
        $this->nickname = $nickname;
        $this->passwordHash = $passwordHash;
        $this->creationDate = $creationDate;
    }

    public function register(string $nickname, string $password): User
    {
        return new User(Uuid::uuid4(), $nickname, password_hash($password, PASSWORD_DEFAULT), new DateTimeImmutable());
    }
}