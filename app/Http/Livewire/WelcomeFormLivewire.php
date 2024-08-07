<?php

namespace App\Http\Livewire;

use App\Events\UserRegisteredEvent;
use App\Jobs\RegisterJob;
use App\Models\User;
use App\Traits\AlertTrait;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class WelcomeFormLivewire extends Component
{
    use AlertTrait;

    public $eventos = [];
    public $showTerms = false;
    public $user;
    public $dni;
    public $name;
    public $email;
    public $phone;
    public $cantidad = 0;
    public $aceptar = false;

    public function render()
    {
        return view('livewire.welcome-form-livewire');
    }

    public function hidePolicies()
    {
        $this->showTerms = false;
    }
    public function displayPolicies()
    {
        $this->showTerms = true;
    }

    public function resetInputs()
    {
        $this->dni = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->cantidad = '';
        $this->showTerms = false;
    }

    public function save()
    {
        $user = User::where('dni', $this->dni)
            ->first();
        $this->validate(
            [
                'dni' => 'required|numeric|digits:8',
                'name' => 'required|string',
                'email' => 'required|email|unique:users,email,' . ($user->id ?? 'null'),
                'phone' => 'required|numeric|digits:9|unique:users,phone,' . ($user->id ?? 'null'),
                'cantidad' => 'required|numeric|min:1',
                'aceptar' => 'accepted',
            ],
            [
                'dni.required' => 'El campo DNI es obligatorio.',
                'dni.numeric' => 'El campo DNI debe ser numérico.',
                'dni.digits' => 'El campo DNI debe tener 8 dígitos.',
                'name.required' => 'El campo Nombre es obligatorio.',
                'email.required' => 'El campo Email es obligatorio.',
                'email.email' => 'El campo Email debe ser un email válido.',
                'email.unique' => 'El campo Email ya está en uso.',
                'phone.required' => 'El campo celular es obligatorio.',
                'phone.numeric' => 'El campo celular debe ser numérico.',
                'phone.digits' => 'El campo celular debe tener 9 dígitos.',
                'phone.unique' => 'El campo celular ya está en uso.',
                'cantidad.required' => 'El campo Cantidad es obligatorio.',
                'cantidad.numeric' => 'El campo Cantidad debe ser numérico.',
                'cantidad.min' => 'El campo Cantidad debe ser mayor a 0.',
                'aceptar.accepted' => 'Debes aceptar los términos y condiciones.',
            ]
        );
        DB::beginTransaction();
        try {
            $user = User::where('dni', $this->dni)
                ->first();
            if (!$user) {
                $user = User::create([
                    'dni' => $this->dni,
                    'name' => $this->name,
                    'email' => $this->email,
                    'phone' => $this->phone,
                    'password' => Hash::make($this->dni),
                ]);
            }
            if ($user->registerUsers()->where('attended', false)->count() == 0) {
                $registro = $user->registerUsers()->create([
                    'tickets' => $this->cantidad,
                    'accepted_terms' => $this->aceptar,
                    'attended' => false,
                ]);
            } else {
                $registro = $user->registerUsers()->where('attended', false)->first();
                $registro->tickets = $this->cantidad + $registro->tickets;
                $registro->accepted_terms = $this->aceptar;
                $registro->save();
            }
            DB::commit();
            if ($registro) {
                broadcast(new UserRegisteredEvent($registro))->toOthers();
            }
            return redirect()->route('gracias');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function updatedDni()
    {
        try {
            //si el dni tiene 8 digitos
            if (strlen($this->dni) == 8) {
                $token = config('services.api_dni_ruc.token');
                $url = config('services.api_dni_ruc.url');

                $user = User::where('dni', $this->dni)
                    ->first() ?? null;

                if ($user != null) {
                    $this->name = $user->name;
                    $this->email = $user->email ?? null;
                    $this->phone = $user->phone ?? null;
                } else {
                    $client = new Client(['base_uri' => $url, 'verify' => false]);
                    $parameters = [
                        'http_errors' => false,
                        'connect_timeout' => 5,
                        'headers' => [
                            'Authorization' => 'Bearer ' . $token,
                            'Referer' => 'https://apis.net.pe/api-consulta-dni',
                            'User-Agent' => 'laravel/guzzle',
                            'Accept' => 'application/json',
                        ],
                        'query' => ['numero' => $this->dni]
                    ];

                    // Para usar la versión 1 de la api, cambiar a /v1/ruc
                    $res = $client->request('GET', '/v1/dni', $parameters);
                    $response = json_decode($res->getBody()->getContents(), true);
                    $status = $res->getStatusCode();
                    if ($status == 200) {
                        $this->name = $response['nombres'] . ' ' . $response['apellidoPaterno'] . ' ' . $response['apellidoMaterno'];
                        $this->email = null;
                        $this->phone = null;
                    } else {
                        $this->name = null;
                        $this->email = null;
                        $this->phone = null;
                        $this->addError('dni', 'DNI no encontrado');
                        $this->addError('name', 'Ingrese sus nombres y apellidos');
                    }
                }
            }
        } catch (\Exception $e) {
            $this->addError('dni', 'DNI no encontrado');
            $this->addError('name', 'Ingrese sus nombres y apellidos');
        }
    }
}
