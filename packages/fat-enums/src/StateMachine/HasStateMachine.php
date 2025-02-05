<?php

namespace ArtisanBuild\FatEnums\StateMachine;

use BackedEnum;
use Exception;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use ReflectionClass;
use ReflectionClassConstant;
use ReflectionProperty;

trait HasStateMachine
{
    public static function bootHasStateMachine(): void
    {
        if (! is_a(static::class, Model::class, true)) {
            throw new Exception('The HasStateMachine::bootHasStateMachine() method can only be used on Eloquent models.');
        }

        if (
            ! property_exists(static::class, 'state_machines')
            || ! (new ReflectionProperty(static::class, 'state_machines'))->getType()?->getName() === 'array'
        ) {
            throw new Exception('The HasStateMachine::bootHasStateMachine() method can only be used on models that define a $state_machines array property.');
        }

        static::updating(function (Model $model): void {
            foreach ($model->getDirty() as $attribute => $value) {
                if (in_array($attribute, $model->state_machines)) {
                    // Make sure the attribute exists in $casts array
                    if (! array_key_exists($attribute, $model->casts)) {
                        throw new InvalidArgumentException("{$attribute} is not a valid cast on ".$model::class);
                    }

                    // Make sure it's an enum
                    if (! enum_exists($model->casts[$attribute])) {
                        throw new InvalidArgumentException("{$model->casts[$attribute]} is not a valid enum.");
                    }

                    // Make sure it implements the StateMachine contract
                    if (! in_array(StateMachine::class, class_implements($model->casts[$attribute]))) {
                        throw new InvalidArgumentException("{$model->casts[$attribute]} does not implement ".StateMachine::class);
                    }

                    if (is_string($value) || is_int($value)) {
                        // string and int BackedEnum
                        $value = $model->casts[$attribute]::from($value);
                    }

                    // This should be structured in a way to support
                    // UnitEnum as well, but for now we're  going to
                    // assume it's a BackedEnum.

                    $original = $model->getOriginal($attribute);

                    // $value->transitionFrom($original);
                    if (! $original->canTransitionTo($value)) {
                        throw new InvalidStateTransition(sprintf(
                            InvalidStateTransition::MESSAGE,
                            $original->value,
                            $value->value,
                            $model::class,
                            $attribute,
                            $model->casts[$attribute],
                        ));
                    }
                }
            }
        });
    }

    public static function onlyRunInVerbsState(): void
    {
        if (! is_a(static::class, \Thunk\Verbs\State::class, true)) {
            throw new Exception('This method can only be used on Verbs States.');
        }
    }

    private static function validateStateMachine(string $property): void
    {
        if (! (new ReflectionClass(static::class))->hasProperty($property)) {
            throw new InvalidArgumentException("Property {$property} does not exist on ".static::class);
        }

        $type = (new ReflectionClass(static::class))
            ->getProperty($property)
            ->getType();

        if (is_null($type)) {
            throw new InvalidArgumentException("Property {$property} does not have a type defined on ".static::class);
        }

        $type = $type->getName();

        if (! enum_exists($type)) {
            throw new InvalidArgumentException("Property {$property} is not an enum on ".static::class);
        }

        if (! in_array(StateMachine::class, class_implements($type))) {
            throw new InvalidStateMachineConfig("Enum {$type} does not implement ".StateMachine::class);
        }

        if (! defined("{$type}::DEFAULT")) {
            throw new InvalidStateMachineConfig("Enum {$type} does not have a DEFAULT defined");
        }
    }

    public static function getDefaultState(string $property): BackedEnum
    {
        static::validateStateMachine($property);

        $type = (new ReflectionClass(static::class))
            ->getProperty($property)
            ->getType()
            ->getName();

        return $type::DEFAULT;
    }

    /**
     * @param  BackedEnum|array<BackedEnum>  $destination
     */
    public function canTransitionTo(
        string $property,
        BackedEnum|array $destination,
    ): bool {
        if (empty($destination)) {
            throw new InvalidArgumentException("Cannot transition '{$property}' to an empty destination");
        }

        $destinations = is_array($destination) ? $destination : [$destination];
        foreach ($destinations as $destination) {
            if (! $this->canTransitionBetween($property, $this->{$property}, $destination)) {
                return false;
            }
        }

        return true;
    }

    public function canTransitionBetween(
        string $property,
        BackedEnum $source,
        BackedEnum $destination,
    ): bool {
        static::validateStateMachine($property);

        assert($source instanceof StateMachine);
        assert($destination instanceof StateMachine);

        // `assert` becomes a no-op in production. So even though
        // it helps with our internal type checking, it doesn't
        // actually provided the needed safety in production.
        foreach ([$source, $destination] as $enum) {
            if (! class_implements($enum, StateMachine::class)) {
                throw new InvalidArgumentException("{$enum->class} does not implement ".StateMachine::class);
            }
        }

        return $source->canTransitionTo($destination);
    }

    public function transitionTo(string $property, mixed $destination): self
    {
        static::validateStateMachine($property);

        $source = $this->{$property};

        if (! $this->canTransitionBetween($property, $source, $destination)) {
            throw new InvalidStateTransition(sprintf(
                'Cannot transition %s from %s to %s on %s',
                $property,
                $source->value,
                $destination->value,
                $this::class,
            ));
        }

        $this->{$property} = $destination;

        return $this;
    }

    public static function serializeStateMachine(string $property): array
    {
        static::validateStateMachine($property);

        $enum = (new ReflectionClass(static::class))
            ->getProperty($property)
            ->getType()
            ->getName();

        $cases = collect($enum::cases());

        $caseValueSorter = function (string $first, string $second) use ($cases, $enum): int {
            $first = $cases->search($enum::from($first));
            $second = $cases->search($enum::from($second));

            return $first <=> $second;
        };

        $config = [
            'Default State' => $enum::DEFAULT->value,
            'Final States' => $cases
                ->filter(fn ($case) => (new ReflectionClassConstant($enum, $case->name))
                    ->getAttributes(FinalState::class)
                )
                ->map(fn ($case) => $case->value)
                ->sort($caseValueSorter)
                ->values()
                ->toArray(),
            'Allowed Transitions' => $cases
                ->mapWithKeys(fn ($case) => [$case->value => $case])
                ->map(fn ($case) => (new ReflectionClassConstant($enum, $case->name))
                    ->getAttributes(CanTransitionTo::class)
                )
                ->reject(fn ($attributes) => empty($attributes))
                ->map(fn ($attributes) => $attributes[0]->newInstance()->destinations)
                ->map(fn ($destinations) => collect($destinations)
                    ->map(fn ($destination) => $destination->value)
                    ->sort($caseValueSorter)
                    ->values()
                    ->toArray()
                )
                ->toArray(),
            'Self Transitions' => $cases
                ->mapWithKeys(fn ($case) => [$case->value => $case])
                ->map(fn ($case) => (new ReflectionClassConstant($enum, $case->name))
                    ->getAttributes(CanTransitionToSelf::class)
                )
                ->reject(fn ($attributes) => empty($attributes))
                ->keys()
                ->sort($caseValueSorter)
                ->values()
                ->toArray(),
        ];

        return [$property => $config];
    }
}
