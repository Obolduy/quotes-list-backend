<?php

namespace App\Http\Controllers;

use App\Models\{Authors, Quotes, TagsList, TagsNames};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddQuoteController extends Controller
{
    public function add(Request $request) {
        $data = $request->all();

        DB::beginTransaction();

        $tags = [];
        foreach ($data['tags'] as $tag_id) {
            $tags[] = TagsNames::find($tag_id);
        }

        $author = Authors::firstOrCreate(['author' => $data['author']]);

        $quote = Quotes::create([
            'author_id' => $author->id,
            'text' => $data['text']
        ]);

        foreach ($tags as $tag) {
            TagsList::create(['tag_id' => $tag->id, 'quote_id' => $quote->id]);
        }

        DB::commit();
    }

    public function checkAuthor(Request $request) {
        $data = $request->all();

        $authors = Authors::where('author', 'like', "%{$data['author']}%")->get();

        if ($authors) {
            return response()->json($authors);
        }
    }
}