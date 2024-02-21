<?php

namespace App\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class BookQueryBuilder extends Builder
{
    public function ofTitle(string $title): self
    {
        return $this->where('title', 'ilike',  "$title%");
    }

    public function ofAuthor(string $author): self
    {
        return $this->where('author', 'ilike',  "$author%");
    }

    public function ofClientFirstName(string $firstName): self
    {
        return $this->whereHas('currentRental.client', fn(Builder $query) => $query->where('first_name', $firstName));
    }

    public function ofClientLastName(string $firstName): self
    {
        return $this->whereHas('currentRental.client', fn(Builder $query) => $query->where('last_name', $firstName));
    }
}
