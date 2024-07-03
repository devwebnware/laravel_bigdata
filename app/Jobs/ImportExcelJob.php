<?php

namespace App\Jobs;

use App\Models\Tag;
use App\Models\Report;
use App\Models\Listing;
use App\Models\Category;
use App\Models\ListingTag;
use App\Models\ParentCategory;
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
    protected $report;

    public function __construct($mappingData, $user, $report)
    {
        $this->mappingData = $mappingData;
        // Logged in user
        $this->user = $user;
        $this->report = $report;
    }

    public function handle(): void
    {
    }

    public function model(array $row)
    {
        try {
            // Chcek for column existance and get listing accordingly
            if (in_array('id', $this->mappingData)) {
                $listing = $this->getListing('id', $row[$this->mappingData['id']]);
            } else if (in_array('landing_url_unique', $this->mappingData)) {
                $url = $row[$this->mappingData['landing_url_unique']];
                $urlParts = parse_url($url);
                // Get the query parameters
                parse_str($urlParts['query'], $query);
                // Extract the 'a' parameter
                $data = $query['a'];
                // Remove hyphens
                $landing_url_unique = str_replace('-', ' ', $data);
                $listing = $this->getListing('name', $landing_url_unique);
            } else if (in_array('name', $this->mappingData)) {
                $listing = $this->getListing('name', $row[$this->mappingData['name']]);
            } else if (in_array('phone_number', $this->mappingData)) {
                $phone_number = substr($row[$this->mappingData['phone_number']], -10);
                $listing = $this->getListing('phone_number', $phone_number);
            } else if (in_array('email', $this->mappingData)) {
                $listing = $this->getListing('email', $row[$this->mappingData['email']]);
            } else if (in_array('business_url', $this->mappingData)) {
                $listing = $this->getListing('business_url', $row[$this->mappingData['business_url']]);
            }
            // If listing exists then update the listing data

            if ($listing !== null) {
                $this->report->matched_records = ++$this->report->matched_records;
                $this->report->update();
                foreach ($this->mappingData as $key => $value) {
                    // $value = database column name
                    // $key = csv file column name
                    switch ($key) {
                        case 'category':
                            if ($row[$key]) {
                                // if category exists then update the category id
                                $category = Category::where('name', $row[$key])->first();
                                if ($category) {
                                    $listing->$value = $category->id;
                                    $listing->update();
                                } else {
                                    // if category not found then create new category and then update the category id
                                    $category = Category::create([
                                        'name' => $row[$key],
                                        'created_by' => $this->user->id
                                    ]);
                                    $listing->$value = $category->id;
                                    $listing->update();
                                }
                            }
                            break;
                        case 'parent_category':
                            if ($row[$key]) {
                                // if category exists then update the category id
                                $category = ParentCategory::where('name', $row[$key])->first();
                                if ($category) {
                                    $listing->$value = $category->id;
                                    $listing->update();
                                } else {
                                    // if category not found then create new category and then update the category id
                                    $category = ParentCategory::create([
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
                                // Example data you get inside $row[$key] = tag4,tag5,tag6 || 4,5,6
                                // Create a array of tags
                                $tags = explode(",", $row[$key]);
                                foreach ($tags as $tagName) {
                                    // Find tags in the listing
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
                        case 'phone_number':
                            if ($row[$key]) {
                                $number = substr($row[$key], -10);
                                $listing->$value = $number;
                                $listing->update();
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
                $this->report->new_records = ++$this->report->new_records;
                $this->report->update();
                // If listing doesn't exist then create a new listing
                $listing = new Listing();
                foreach ($this->mappingData as $key => $value) {

                    // $value = database column name
                    // $key = csv file column name

                    switch ($key) {
                        case 'category':
                            if ($row[$key]) {
                                $category = Category::where('name', 'like', "%{$row[$key]}%")->first();
                                // If category exists then update the category id
                                if ($category) {
                                    $listing->category = $category->id;
                                } else {
                                    // If category doesn't exist then create a new category and update the category id
                                    $category = new Category();
                                    $category->name = $row[$key];
                                    $category->created_by = $this->user->id;
                                    $category->save();
                                    $listing->category = $category->id;
                                }
                            }
                            break;
                        case 'parent_category':
                            if ($row[$key]) {
                                $parentCategory = ParentCategory::where('name', 'like', "%{$row[$key]}%")->first();

                                // If category exists then update the category id
                                if ($parentCategory) {
                                    $listing->parent_category = $parentCategory->id;
                                } else {
                                    // If category doesn't exist then create a new category and update the category id
                                    $parentCategory = new ParentCategory();
                                    $parentCategory->name = $row[$key];
                                    $parentCategory->created_by = $this->user->id;
                                    $parentCategory->save();
                                    $listing->parent_category = $parentCategory->id;
                                }
                            }
                            break;
                        case 'tag':
                            if ($row[$key] !== null) {
                                // Example data you get inside $row[$key] = tag4,tag5,tag6 || 4,5,6
                                // Create a array of tags
                                $tags = explode(",", $row[$key]);
                                // Save the listing so we can get the listing id inside the loop
                                $listing->save();
                                foreach ($tags as $tag) {
                                    // find tag by id or name
                                    if (is_numeric($tag)) {
                                        $tagModel = Tag::find($tag);
                                    } else {
                                        $tagModel = Tag::where('name', 'like', "%{$tag}%")->first();
                                    }
                                    // If tag exists then create a pivot relational table for listing and tags
                                    if ($tagModel) {
                                        $listingTag = new ListingTag();
                                        $listingTag->listing_id = $listing->id;
                                        $listingTag->tag_id = $tagModel->id;
                                        $listingTag->save();
                                    }
                                }
                            }
                            break;
                        case 'phone_number':
                            if ($row[$key]) {
                                // Get only the last 10 digits of the phone number
                                $number = substr($row[$key], -10);
                                $listing->$value = $number;
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
        } catch (\Exception $e) {
            Log::error("Error processing row: " . $e->getMessage());
            return null;
        }
    }

    public function chunkSize(): int
    {
        return 150; // Change chunk size according to your needs.
    }
    public function startRow(): int
    {
        return 2; // Skip the first row if it contains headers
    }
    public function getListing($column, $value)
    {
        $listing = Listing::where($column, $value)->with('listingTags')->first();
        return $listing;
    }
}
