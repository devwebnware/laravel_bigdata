<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ImportExcelJob implements ToModel, WithChunkReading, ShouldQueue, WithHeadingRow
{
    protected $mappingData;
    protected $user;

    public function __construct($mappingData, $user)
    {
        $this->mappingData = $mappingData;
        $this->user = $user;
    }

    public function handle(): void
    {
    }

    public function model(array $row)
    {
        // If id column exists it will find the record using the id else it will find the record using the name
        if (in_array('id', $this->mappingData)) {
            $listing = Listing::where('id', $row[$this->mappingData['id']])->with('listingTags')->first();
        } else {
            $listing = Listing::where('name', $row[$this->mappingData['name']])->with('listingTags')->first();
        }

        if ($listing !== null) {
            foreach ($this->mappingData as $key => $value) {
                // $value = database column name
                // $key = csv file column name
                switch ($key) {
                    case 'category':
                        if ($row[$key]) {
                            $category = Category::where('name', $row[$key])->first();
                            if ($category) {
                                $listing->$value = $category->id;
                                $listing->update();
                            } else {
                                $category = Category::create([
                                    'name' => $row[$key],
                                    'created_by' => $this->user->id
                                ]);
                                $listing->$value = $category->id;
                                $listing->update();
                            }
                        }
                        break;
                    case 'tag':
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
                        if ($value !== 'id') {
                            $listing->$value = $row[$key];
                            $listing->update();
                        };
                        break;
                }
            }
        } else {
            $listing = new Listing();
            foreach ($this->mappingData as $key => $value) {

                // $value = database column name
                // $key = csv file column name

                switch ($key) {
                    case 'category':
                        if ($row[$key]) {
                            $category = Category::where('name', 'like', "%{$row[$key]}%")->first();
                            if ($category) {
                                $listing->category = $category->id;
                            } else {
                                $category = new Category();
                                $category->name = $row[$key];
                                $category->created_by = $this->user->id;
                                $category->save();
                                $listing->category = $category->id;
                            }
                        }
                        break;
                    case 'tag':
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
    public function startRow(): int
    {
        return 2; // Skip the first row if it contains headers
    }
}
