<?php

namespace App\Http\Controllers;

use App\Models\{TagsNames, Quotes};
use Illuminate\Http\Request;

class ShowQuotesController extends Controller
{
    public function showQuotes() {
        $quotes = Quotes::select('quotes.text', 'quotes.created_at', 'quotes.id as quote_id', 'authors.author')
                        ->join('authors', 'quotes.author_id', 'authors.id')
                        ->orderByDesc('quotes.created_at')
                        ->paginate(10);

        $tags = [];

        foreach ($quotes as $quote) {
            $tags[] = TagsNames::select('tags_names.tag')
                                ->join('tags_list', 'tags_names.id', 'tags_list.tag_id')
                                ->where('tags_list.quote_id', $quote->quote_id)
                                ->get();
        }

        return response()->json(['quotes' => $quotes, 'tags' => $tags]);
    }

    public function showQuote(int $id) {
        $quote = Quotes::select('quotes.*', 'authors.author')
                        ->join('authors', 'quotes.author_id', 'authors.id')
                        ->where('quotes.id', $id)
                        ->first();

        $tags = TagsNames::select('tags_names.tag')
                            ->join('tags_list', 'tags_names.id', 'tags_list.tag_id')
                            ->where('tags_list.quote_id', $quote->id)
                            ->get();

        return response()->json(['quote' => $quote, 'tags' => $tags]);
    }
}