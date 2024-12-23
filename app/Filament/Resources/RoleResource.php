<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RoleResource\Pages;
use App\Models\Role;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Permission;
use Filament\Forms\Components\Grid;
use Filament\Tables\Columns\TextColumn;

class RoleResource extends Resource
{
    protected static ?string $model = Role::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required(),
                TextInput::make('guard_name')
                    ->default('web'),
                Grid::make(2)
                    ->schema([
                        CheckboxList::make('permissions')
                            ->label('Admin Permissions')
                            ->options(Permission::where('group', '=', 'admin')->pluck('name', 'id'))
                            ->columns(2) // Adjust the number of columns for layout
                            ->bulkToggleable(), // Enables "ch
                        // CheckboxList::make('permissions')
                        //     ->label('Dashboard Permissions')
                        //     ->options(Permission::all()->pluck('name', 'id'))
                        //     ->columns(2) // Adjust the number of columns for layout
                        //     ->bulkToggleable(), // Enables "ch

                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->rowIndex(),
                TextColumn::make('name'),
                TextColumn::make('users.name')->limit(50)
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
            'index' => Pages\ListRoles::route('/'),
            'create' => Pages\CreateRole::route('/create'),
            'edit' => Pages\EditRole::route('/{record}/edit'),
        ];
    }
}
