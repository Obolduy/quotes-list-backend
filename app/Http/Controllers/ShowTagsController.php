<?php

namespace App\Http\Controllers;

use App\Models\TagsNames;

class ShowTagsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/get-tags",
     *     @OA\Response(response="200", description="Возвращает список тегов")
     * )
     */

    public function getTags()
    {
        $tags = [];

        foreach (TagsNames::all() as $tag) {
            $tags[] = $tag->tag;
        }

        return response()->json($tags);
    }
}