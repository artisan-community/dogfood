<?php

namespace ArtisanBuild\FatEnums\StateMachine;

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Satisfies the Thunk\Verbs\SerializedByVerbs Contract.
 */
trait SerializesForVerbs
{
    public function serializeForVerbs(NormalizerInterface $normalizer): string
    {
        return $this->value;
    }

    public static function deserializeForVerbs(array $data, DenormalizerInterface $denormalizer): static
    {
        return static::from($data);
    }
}
