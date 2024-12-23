<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Kodeine\Metable\Metable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Permission\Traits\HasRoles;
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasOne;


class User extends Authenticatable implements HasMedia,MustVerifyEmail,FilamentUser
{
    use HasApiTokens, Metable, InteractsWithMedia, HasRoles;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];
    /**
     * The Metatable
     */
    protected $metaTable = 'user_meta';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $meta_fields = [
        'first_name',
        'last_name',
        'tel_no',
        'mobile',
        'whatsapp',
        'facebook',
        'linkedin',
        'facebook',
    ];


    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function canAccessPanel(Panel $panel): bool
    {
        return str_ends_with($this->email, 'admin@email.com');
    }
    /**
     * driver has one user
     *
     * @return void
     */
    public function driver():HasOne{
        return $this->hasOne(Driver::class);
    }
    /**
     * Add media collection to your model
     * @return
     */
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('upload_profile_image')
            ->singleFile()
            ->useFallbackUrl(asset('/images/user-avatar.jpg'))
            ->useFallbackPath(public_path('/images/user-avatar.jpg'));
    }

    /**
     * Add media conversions
     * @param  Media|null
     * @return [type]
     */
    public function registerMediaConversions(Media $media = null): void
    {
        // Add thumb Image
        $this->addMediaConversion('thumb')
            ->nonQueued()
            // ->crop('crop-center', 150, 150)
            ->width(150)
            ->height(150)
            ->sharpen(10)
            ->performOnCollections('upload_profile_image');


        // Add Medium Image
        $this->addMediaConversion('medium')
            ->nonQueued()
            ->width(300)
            ->height(300)
            ->sharpen(10)
            ->performOnCollections('upload_profile_image');

        // Add large Image
        $this->addMediaConversion('banner')
            ->nonQueued()
            ->width(1020)
            ->height(600)
            ->sharpen(10)
            ->performOnCollections('upload_profile_image');
    }
}
