<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Traits\AdminTraits\User\UserTrait;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;

class UserResource extends Resource
{
    use UserTrait;
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = 'Users';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        if ($form->getOperation() == "edit") {
            return $form->schema([
                Section::make('Information')->schema([
                    Grid::make(2)
                        ->schema(
                            self::informationFields()
                        )
                ]),
            ]);
        } else {
            return $form->schema([
                Section::make('Information')->schema([
                    Grid::make(2)
                        ->schema(
                            self::informationFields()
                        )
                ]),
            ]);
        }
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('upload_profile_image')
                    ->label('Avatorx')
                    ->collection('upload_profile_image')
                    ->conversion('thumb'),
                TextColumn::make('name')
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
                TextColumn::make('email'),
                TextColumn::make('roles.name')
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
