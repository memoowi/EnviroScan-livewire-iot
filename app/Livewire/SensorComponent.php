<?php

namespace App\Livewire;

use App\Models\Sensor;
use Livewire\Component;

class SensorComponent extends Component
{
    public $temperature;
    public $humidity;
    public function render()
    {
        $sensors = Sensor::latest()->first();
        $this->temperature = $sensors->temperature;
        $this->humidity = $sensors->humidity;
        return view('livewire.sensor-component');
    }
    public function update()
    {
        Sensor::where('id', 1)->update([
            'temperature' => request()->temperatureValue,
            'humidity' => request()->humidityValue,
        ]);
    }
}
