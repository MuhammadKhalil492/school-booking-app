<?php

namespace App\Traits\AdminTraits\User;

// use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;

trait UserTrait
{
    //
    protected static function informationFields()
    {
        $fields = [
            TextInput::make('name')
                ->required(),
            TextInput::make('email')
                ->email()
                ->required(),
            TextInput::make('password'),
            TextInput::make('mobile')
                ->numeric(),
            SpatieMediaLibraryFileUpload::make('profile_image')
                ->collection('profile_image'),
            Select::make('roles')
                ->label("Roles")
                ->relationship(
                    name: 'roles',
                    titleAttribute: 'name',
                    modifyQueryUsing: function (Builder $query): Builder {
                        if (Gate::allows('gate_superviosor')) {
                            $query->whereIn('name', ['admin']);
                        }
                        return $query;
                    },
                )
                ->multiple()
        ];
        return $fields;
    }
}
