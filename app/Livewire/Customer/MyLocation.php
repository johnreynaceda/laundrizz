<?php

namespace App\Livewire\Customer;

use App\Models\Location;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class MyLocation extends Component implements HasForms
{
    use InteractsWithForms;
    public $add_modal = false;
    public $is_edit = false;
    public $location_id;
    public $name, $contact, $address, $is_default = false;

    public function mount()
    {
        $this->name = auth()->user()->name;
    }

    public function updatedIsEdit()
    {
        if ($this->is_edit) {
            $this->name = auth()->user()->name;

        }
    }

    public function addLocation()
    {
        $this->is_edit = false;
        $this->add_modal = true;
        $this->location_id = null;
        $this->reset(['contact', 'address', 'is_default']);
    }

    public function editLocation($location_id)
    {
        $this->is_edit = true;
        $this->location_id = $location_id;
        $location = Location::find($location_id);
        $this->name = $location->user->name;
        $this->contact = $location->contact;
        $this->address = $location->address;
        $this->is_default = $location->is_default;
        $this->add_modal = true;
    }

    public function delete()
    {
        $location = Location::find($this->location_id);
        $location->delete();
        $this->add_modal = false;
        $this->location_id = null;
        $this->reset(['contact', 'address', 'is_default']);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('CONTACT INFORMATION')->schema([
                    TextInput::make('name')->disabled()
                        ->required(),
                    TextInput::make('contact')->prefix('+63')
                        ->required(),
                ]),
                Fieldset::make('ADDRESS INFORMATION')->schema([
                    // Textarea::make('address')->placeholder('Put your correct information here.')->tooltip("Ex. San Juan St. Blck. 1, Brgy. Buenaflor, Tacurong City, Sultan Kudarat")
                    Textarea::make('address')->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Ex. San Juan St. Blck. 1, Brgy. Buenaflor, Tacurong City, Sultan Kudarat')->required(),
                    Toggle::make('is_default')->onColor('success')->label('Set as default')->offColor('gray')

                ]),
            ]);
    }
    public function save()
    {
        sleep(1);
        if (!$this->is_edit) {
            $this->validate([
                'contact' => 'required|digits:10', // Adjust digit limit as needed
                'address' => ['required', 'string', 'max:255'],
                'is_default' => ['required', 'boolean'],
            ]);

            Location::create([
                'user_id' => auth()->user()->id,
                'contact' => '0' . $this->contact,
                'address' => $this->address,
                'is_default' => $this->is_default,
            ]);
            $this->reset(['contact', 'address', 'is_default']);
        } else {
            $this->validate([
                'contact' => 'required|digits:10', // Ensures exactly 11 digits
                'address' => ['required', 'string', 'max:255'],
                'is_default' => ['required', 'boolean'],
            ]);

            // Find and update the existing default location
            $defaultLocation = Location::where('user_id', auth()->user()->id)
                ->where('is_default', true)
                ->first();

            if ($defaultLocation) {
                $defaultLocation->update(['is_default' => false]);
            }

            // Find and update the specified location
            $location = Location::find($this->location_id);
            if ($location) {
                $location->update([
                    'contact' => '0' . $this->contact,
                    'address' => $this->address,
                    'is_default' => $this->is_default,
                ]);
            }

            // Reset component state
            $this->reset(['contact', 'address', 'is_default']);
            $this->location_id = null;
            $this->is_edit = false;

        }
        $this->add_modal = false;
    }

    public function render()
    {
        return view('livewire.customer.my-location', [
            'locations' => Location::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
