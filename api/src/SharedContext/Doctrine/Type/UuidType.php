<?php

namespace App\SharedContext\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidType extends Type
{
    const UUID = 'uuid'; // Custom type name

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        // Return the appropriate SQL type based on the platform
        return $platform->getName() === 'postgresql' ? 'UUID' : 'BINARY(16)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?UuidInterface
    {
        return $value ? Uuid::fromString($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        return $value instanceof UuidInterface ? $value->toString() : null;
    }

    public function getName(): string
    {
        return self::UUID;
    }
}
