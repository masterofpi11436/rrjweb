<?php

namespace App\Livewire\Camera;

use Livewire\Component;

use App\Models\Camera\Camera;
use App\Enums\CameraStatus;
use App\Enums\CameraType;

class CameraForm extends Component
{
    public $cameraId;
    public $camera_number;
    public $camera_name;
    public $camera_type;
    public $location;
    public $status;
    public $encoder_switch_location;
    public $ip_address;

    protected function rules()
    {
        $cameraId = $this->cameraId ?? 'NULL';

        return [
            'camera_number' => 'required|max:255|unique:camera_statuses,camera_number,' . $cameraId,
            'camera_name' => 'required|max:255',
            'camera_type' => 'required|in:' . implode(',', CameraType::values()),
            'location' => 'required|max:255',
            'status' => 'required|in:' . implode(',', CameraStatus::values()),
            'encoder_switch_location' => 'required|max:255',
            'ip_address' => 'required|ip',
        ];
    }

    public function mount($id = null)
    {
        if ($id) {

            $camera = Camera::findOrFail($id);

            $this->cameraId = $camera->id;

            $this->camera_number = $camera->camera_number;
            $this->camera_name = $camera->camera_name;
            $this->camera_type = $camera->camera_type->value;
            $this->location = $camera->location;
            $this->status = $camera->status->value;
            $this->encoder_switch_location = $camera->encoder_switch_location;
            $this->ip_address = $camera->ip_address;
        }
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function submitForm()
    {
        $validatedData = $this->validate();

        if ($this->cameraId) {

            $camera = Camera::findOrFail($this->cameraId);

            $camera->update($validatedData);

            session()->flash(
                'create-edit-delete-message',
                'Camera updated successfully!'
            );

        } else {

            $camera = Camera::create($validatedData);

            session()->flash(
                'create-edit-delete-message',
                'Camera created successfully!'
            );
        }

        $this->reset([
            'camera_number',
            'camera_name',
            'camera_type',
            'location',
            'status',
            'encoder_switch_location',
            'ip_address',
        ]);

        return redirect()->route('camera.dashboard');
    }

    public function render()
    {
        return view('Camera.livewire.camera-form');
    }
}
