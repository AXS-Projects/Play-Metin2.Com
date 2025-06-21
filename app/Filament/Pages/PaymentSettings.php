<?php

namespace App\Filament\Pages;

use Filament\Forms; 
use Filament\Pages\Page; 
use Filament\Forms\Components\TextInput; 
use App\Models\Setting; 

class PaymentSettings extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Payment';
    protected static ?string $title = 'Payment Settings';
    protected static ?string $slug = 'settings/payment';
    protected static string $view = 'filament.pages.payment-settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'stripe_public_key' => Setting::getValue('stripe_public_key'),
            'stripe_secret_key' => Setting::getValue('stripe_secret_key'),
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('stripe_public_key')
                ->label('Stripe Public Key')
                ->required(),
            TextInput::make('stripe_secret_key')
                ->label('Stripe Secret Key')
                ->required(),
        ];
    }

    public function submit(): void
    {
        $data = $this->form->getState();

        Setting::updateOrCreate(
            ['key' => 'stripe_public_key'],
            ['value' => $data['stripe_public_key']]
        );

        Setting::updateOrCreate(
            ['key' => 'stripe_secret_key'],
            ['value' => $data['stripe_secret_key']]
        );

        $this->notify('success', 'Stripe settings updated.');
    }
}
