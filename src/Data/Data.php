<?php

namespace Khomeriki\BitgoWallet\Data;

use JetBrains\PhpStorm\Pure;

abstract class Data
{
    /**
     * convert data from array to object
     * @param array $payload
     * @return static
     */
    #[Pure]
 public static function fromArray(array $payload): static
 {
     $dataClass = static::class;
     $dto = new $dataClass();
     foreach ($payload as $key => $value) {
         if (property_exists($dto, $key)) {
             $dto->$key = $value;
         }
     }

     return $dto;
 }

    /**
     * convert data object to array
     * @return array
     */
    public function toArray(): array
    {
        $arr = (array)$this;
        array_walk_recursive($arr, function (&$item) {
            if (is_object($item)) {
                $item->toArray();
                $item = (array)$item;
            }
        });

        return $arr;
    }
}
