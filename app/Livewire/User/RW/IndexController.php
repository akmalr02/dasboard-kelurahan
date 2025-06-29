<?php

namespace App\Livewire\User\RW;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Warga;

class IndexController extends Component
{
    protected string $layout = 'layouts.app';
    public $showModal = false;
    public $selectedWarga = null;

    public function showDetail($id)
    {
        $this->selectedWarga = Warga::findOrFail($id);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedWarga = null;
    }

    public function render()
    {
        $user = Auth::user();

        $data = collect();

        if ($user->warga && $user->warga->NKK) {
            $data = Warga::where('NKK', $user->warga->NKK)
                ->where('status_penduduk', 'hidup')
                ->get();
        }

        // dd($data);
        return view('livewire.user.r-w.index', [
            'title' => 'Data Keluarga',
            'keluarga' => $data
        ]);
    }
}
