<?php

namespace App\Services;

use App\DTO\Book\BookSearchData;
use App\Models\Book;
use App\QueryBuilders\BookQueryBuilder;

class BookService
{
    public function queryBySearchData(BookSearchData $bookSearchData): BookQueryBuilder
    {
        $query = Book::query();

        if($bookSearchData->title !== null) {
            $query->ofTitle($bookSearchData->title);
        }

        if($bookSearchData->author !== null) {
            $query->ofAuthor($bookSearchData->author);
        }

        if($bookSearchData->clientFirstName !== null) {
            $query->ofClientFirstName($bookSearchData->clientFirstName);
        }

        if($bookSearchData->clientLastName !== null) {
            $query->ofClientLastName($bookSearchData->clientLastName);
        }

        return $query;
    }
}
