<?php

namespace App\Model\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class MovieDTO
{
    public function __construct(
        #[Assert\NotNull]
        #[Assert\Type('string')]
        public string $title,

        #[Assert\NotNull]
        #[Assert\Type('string')]
        public string $director_name,

        #[Assert\NotNull]
        #[Assert\Type('string')]
        public string $director_surname,
    ) {
    }
}
