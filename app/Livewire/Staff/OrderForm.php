<?php

namespace App\Livewire\Staff;

use App\Models\Catalog;
use App\Models\CatalogService;
use App\Models\OrderDetail;
use App\Models\ServiceTransaction;
use App\Models\TransactionOrderForm;
use Carbon\Carbon;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class OrderForm extends Component implements HasForms
{
    use InteractsWithForms;
    public $order_id;
    public $order;

    public $catalogs = [];
    public $newItems = [[]];

    public $estimated_time;

    public function mount(){
        $this->order_id = request('id');
        $this->order = ServiceTransaction::where('id', $this->order_id)->first();

        

    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
              
                
                Repeater::make('newItems')
                ->label('')
                ->schema([
                    Select::make('catalog')
                        ->options(Catalog::all()->pluck('name', 'id'))
                        ->reactive() // Ensure reactivity when catalog changes
                        ->required(),
            
                    Select::make('service')
                        ->options(function (callable $get) {
                            // Get the selected catalog ID
                            $catalogId = $get('catalog');
            
                            // Get all selected services from other items in the repeater
                            $selectedServices = collect($get('../../newItems'))
                                ->pluck('service')
                                ->filter() // Remove null values
                                ->unique() // Ensure unique service IDs
                                ->toArray();
            
                            // Get the currently selected service for this item
                            $currentService = $get('service');
            
                            // Include the current service in the dropdown options
                            if ($currentService) {
                                $selectedServices = array_diff($selectedServices, [$currentService]);
                            }
            
                            // Fetch services for the selected catalog, excluding already selected services
                            return $catalogId
                                ? CatalogService::where('catalog_id', $catalogId)
                                    ->whereNotIn('id', $selectedServices) // Exclude selected services
                                    ->pluck('name', 'id')
                                : [];
                        })
                        ->reactive() // Ensure reactivity when catalog or services change
                        ->required()
                        ->disabled(fn (callable $get) => empty($get('catalog'))), // Disable if no catalog is selected
            
                    TextInput::make('quantity')
                        ->required()
                        ->disabled(fn (callable $get) => empty($get('catalog'))) // Disable if no catalog is selected
                        ->numeric(),
            
                    TextInput::make('weight')
                        ->required()
                        ->disabled(fn (callable $get) => empty($get('catalog'))) // Disable if no catalog is selected
                        ->numeric()->reactive(),
                ])
                ->columns(2)
                ->addActionLabel('Add Item')
                
            ]);
    }

    public function saveOrder(){
       foreach ($this->newItems as $key => $value) {
        $catalog = CatalogService::where('id', $value['service'])->first();
        TransactionOrderForm::create([
            'service_transaction_id' => $this->order_id,
            'catalog_id' => $value['catalog'],
           'catalog_service_id' => $value['service'],
            'quantity' => $value['quantity'],
            'weight' => $value['weight'],
            'total' => $catalog->price * $value['weight'],
        ]);
       }

       OrderDetail::create([
        'service_transaction_id' => $this->order_id,
        'reference_number' => Carbon::parse(now())->format('ymd'). '0'.$this->order_id,
        'estimated_time' => Carbon::parse($this->estimated_time)->format('h:i A'),
       ]);

       $this->order->update([
           'status' => 'placed order',
       ]);

       return redirect()->route('dashboard');
    }

   

    public function render()
    {
        
        return view('livewire.staff.order-form',[
            'newItems' => $this->newItems,
        ]);
    }
}
