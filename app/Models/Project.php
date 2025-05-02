<?php

namespace App\Models;

use App\Enums\ProjectCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Project extends Model implements HasMedia
{
    use InteractsWithMedia, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'category',
        'is_published',
        'published_at'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'category' => ProjectCategories::class,
            'is_published' => 'boolean',
            'published_at' => 'datetime'
        ];
    }

    public static function booted(): void
    {
        static::creating(function (self $project) {
            $project->slug = Str::slug($project->title, '-', app()->getLocale());

            if ($project->is_published) {
                $project->published_at = now();
            }
        });

        static::updating(function (self $project) {
            if ($project->isDirty('title')) {
                $project->slug = Str::slug($project->title);
            }

            if ($project->isDirty('is_published')) {
                if ($project->is_published) {
                    $project->published_at = now();
                } else {
                    $project->published_at = null;
                }
            }
        });
    }

    /**
     * Get the tags associated with this model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Tag>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Register media collections for the model.
     *
     * This method defines the media collections that the model will use,
     * including the 'main_image' collection which allows a single file,
     * and the 'gallery' collection which can store multiple files.
     *
     * @return void
     */
    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('main_image')
            ->singleFile();

        $this
            ->addMediaCollection('gallery');
    }

    /**
     * Register media conversions for the model.
     *
     * This method defines the conversions that will be applied to media files,
     * including a 'preview' conversion for images in the 'gallery' collection
     * and an 'original' conversion for the 'main_image' collection.
     *
     * @param Media|null $media The media instance to apply conversions to.
     *
     * @return void
     */
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->performOnCollections('gallery')
            ->format('webp')
            ->width(800)
            ->height(600)
            ->optimize()
            ->nonQueued();

        $this->addMediaConversion('original')
            ->performOnCollections('main_image')
            ->keepOriginalImageFormat()
            ->optimize()
            ->nonQueued();
    }

    /**
     * Get the truncated description attribute.
     *
     * This method returns the description attribute of the model, stripped
     * of any HTML tags, and truncated to a predefined length.
     *
     * @return string The truncated description.
     */
    public function getTruncatedDescriptionAttribute(): string
    {
        $stripped = strip_tags($this->description);
        return Str::limit($stripped);
    }
}
