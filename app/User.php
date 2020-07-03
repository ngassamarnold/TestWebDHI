<?php

namespace App;

use App\Models\Role as ModelsRole;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use \TCG\Voyager\Models\Role;
use Illuminate\Notifications\Messages\NexmoMessage;


class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'matricule', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roless()
    {
          return ModelsRole::where('id', Auth::user()->role_id)->first()->name;
    }

    public function sendMessage($message, $recipients)
    {
        try {


            $basic  = new \Nexmo\Client\Credentials\Basic('a9d97580', '0Qyc3WTK0UYvxvjn');
            $client = new \Nexmo\Client($basic);

            $message = $client->message()->send([
                'to' => $recipients,
                'from' => 'HelpToFind',
                'text' => $message
            ]);

            $response = $message->getResponseData();

            if($response['messages'][0]['status'] == 0) {
                $statut = "Le message a été envoyé avec succès\n";
            } else {
                $statut = "Le message a échoué avec le statut: " . $response['messages'][0]['status'] . "\n";
            }
        } catch (Exception $e) {
            $statut = "Le message n'a pas été envoyé. Erreur: " . $e->getMessage() . "\n";
        }

        return $statut;
    }

    // /**
    //  * Get the user's role.
    //  *
    //  * @return string
    //  */
    // public function rolesss()
    // {
    //     $role = Role::find(Auth::user()->role_id);
    //     return $role != null ? $role->name : 'user';
    // }

    /**
     * Check if the user has the specified role
     *
     * @param array|string $role
     * @return bool
     */
    public function hasRole($role)
    {
        $r = Role::find($this->role_id);

        if ($r != null && $r->name == $role) {
            return true;
        }

        return false;
    }


}
