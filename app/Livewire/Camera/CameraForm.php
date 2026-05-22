<?php

namespace App\Livewire\Camera;

use Livewire\Component;
use App\Models\Camera\Camera;
use App\Enums\CameraStatus;
use App\Enums\CameraType;
use App\Enums\CameraNVR;

class CameraForm extends Component
{
    public $cameraId;

    public $camera_number;
    public $camera_name;
    public $encoder_switch_location;
    public $encoder_switch_name;
    public $encoder_port;
    public $camera_model;
    public $ip_address;
    public $firmware_version;
    public $credentials = [
        'username' => '',
        'password' => '',
    ];
    public $nvr;
    public $notes;
    public $camera_type;
    public $location;
    public $status;

    protected function rules()
    {
        $cameraId = $this->cameraId ?? 'NULL';

        return [
            'camera_number' => 'required|max:255|unique:camera_statuses,camera_number,' . $cameraId,
            'camera_name' => 'required|max:255',
            'encoder_switch_location' => 'required|max:255',
            'encoder_switch_name' => 'required|max:255',
            'encoder_port' => 'nullable|max:255',
            'camera_model' => 'nullable|max:255',
            'ip_address' => 'required|ip',
            'firmware_version' => 'nullable|max:255',
            'credentials' => 'required|array',
            'credentials.username' => 'required|max:255',
            'credentials.password' => 'required|max:255',
            'nvr' => 'required|in:' . implode(',', CameraNVR::values()),
            'notes' => 'nullable|string',
            'camera_type' => 'required|in:' . implode(',', CameraType::values()),
            'location' => 'required|max:255',
            'status' => 'required|in:' . implode(',', CameraStatus::values()),
        ];
    }

    public function mount($id = null)
    {
        if ($id) {
            $camera = Camera::findOrFail($id);

            $this->cameraId = $camera->id;

            $this->camera_number = $camera->camera_number;
            $this->camera_name = $camera->camera_name;
            $this->encoder_switch_location = $camera->encoder_switch_location;
            $this->encoder_switch_name = $camera->encoder_switch_name;
            $this->encoder_port = $camera->encoder_port;
            $this->camera_model = $camera->camera_model;
            $this->ip_address = $camera->ip_address;
            $this->firmware_version = $camera->firmware_version;
            $this->credentials = $camera->credentials ?? [
                'username' => '',
                'password' => '',
            ];
            $this->nvr = $camera->nvr?->value;
            $this->notes = $camera->notes;
            $this->camera_type = $camera->camera_type->value;
            $this->location = $camera->location;
            $this->status = $camera->status->value;
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
            Camera::create($validatedData);

            session()->flash(
                'create-edit-delete-message',
                'Camera created successfully!'
            );
        }

        $this->reset([
            'camera_number',
            'camera_name',
            'encoder_switch_location',
            'encoder_switch_name',
            'encoder_port',
            'camera_model',
            'ip_address',
            'firmware_version',
            'credentials',
            'nvr',
            'notes',
            'camera_type',
            'location',
            'status',
        ]);

        $this->credentials = [
            'username' => '',
            'password' => '',
        ];

        return redirect()->route('camera.dashboard');
    }

    public function deleteCamera()
    {
        $camera = Camera::findOrFail($this->cameraId);

        $camera->delete();

        session()->flash(
            'create-edit-delete-message',
            'Camera deleted successfully!'
        );

        return redirect()->route('camera.dashboard');
    }

    public function render()
    {
        return view('Camera.livewire.camera-form');
    }
}
