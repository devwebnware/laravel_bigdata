<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use Hamcrest\Type\IsNumeric;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class ImportDataJob implements ToModel, WithChunkReading, ShouldQueue, WithHeadingRow
{
    protected $mappingData;

    public function __construct($mappingData)
    {
        $this->mappingData = $mappingData;
    }

    public function handle(): void
    {
    }

    public function model(array $row)
    {
        $listing = Listing::where('name', $row[$this->mappingData['name']])->with('listingTags')->first();

        if ($listing !== null) {
            foreach ($this->mappingData as $key => $value) {
                // $value = database column name
                // $key = csv file column name
                switch ($key) {
                    case 'category_id':
                        if ($row[$key]) {
                            if (gettype($row[$key]) === 'string') {
                                $category = Category::where('name', 'like', "%{$row[$key]}%")->first();
                            } else {
                                $category = Category::find($row[$key]);
                            }
                            if ($category) {
                                $listing->update([
                                    $value => $category->id
                                ]);
                            }
                        }
                        break;
                    case 'tag_id':
                        if ($row[$key]) {
                            $tags = explode(",", $row[$key]);
                            foreach ($tags as $tagName) {
                                $listedTag = $listing->listingTags->filter(function ($tag) use ($tagName) {
                                    return stripos($tag->name, $tagName) !== false;
                                })->first();
                                if ($listedTag == null) {
                                    if (is_numeric($tagName)) {
                                        $tagModel = Tag::find($tagName);
                                    } else {
                                        $tagModel = Tag::where('name', 'like', "%{$tagName}%")->first();
                                    }
                                    if ($tagModel) {
                                        $listingTag = new ListingTag();
                                        $listingTag->listing_id = $listing->id;
                                        $listingTag->tag_id = $tagModel->id;
                                        $listingTag->save();
                                    }
                                }
                            }
                        }
                        break;
                    default:
                        $listing->update([
                            $value => $row[$key]
                        ]);
                        break;
                }
            }
        } else {
            $listing = new Listing();
            foreach ($this->mappingData as $key => $value) {

                // $value = database column name
                // $key = csv file column name

                switch ($key) {
                    case 'category_id':
                        if ($row[$key]) {
                            if (gettype($row[$key]) === 'string') {
                                $category = Category::where('name', 'like', "%{$row[$key]}%")->first();
                            } else {
                                $category = Category::find($row[$key]);
                            }
                            if ($category) {
                                $listing->category_id = $category->id;
                            }
                        }
                        break;
                    case 'tag_id':
                        if ($row[$key] !== null) {
                            $tags = explode(",", $row[$key]);
                            $listing->save();
                            foreach ($tags as $tag) {
                                if (is_numeric($tag)) {
                                    $tagModel = Tag::find($tag);
                                } else {
                                    $tagModel = Tag::where('name', 'like', "%{$tag}%")->first();
                                }
                                if ($tagModel) {
                                    $listingTag = new ListingTag();
                                    $listingTag->listing_id = $listing->id;
                                    $listingTag->tag_id = $tagModel->id;
                                    $listingTag->save();
                                }
                            }
                        }
                        break;
                    default:
                        $listing->$value = $row[$key];
                        $listing->save();
                        break;
                }
            }
            $listing->save();
        }

        return $listing;
    }

    public function chunkSize(): int
    {
        return 100; // Change chunk size according to your needs.
    }
}
