<?php

namespace App\Filament\Tenant\Resources\DebtResource\RelationManagers;

use App\Models\Tenants\Setting;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class DebtItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'debtItems';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name'),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('price')
                    ->money(Setting::get('currency', 'OMR')),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money(Setting::get('currency', 'OMR')),
            ])
            ->filters([
                //
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
