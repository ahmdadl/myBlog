<?php declare(strict_types = 1);

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Declare Permission constants
     * 
     * normal user => declare posts and assign categoreis to them
     * team memmber user => change teams posts
     * super user => above with any team and edit|remove categories
     * admin => change user access level
     */
    const ADD_POSTS = 1;
    const DELETE_POSTS = 2;
    const ADD_CATEGORIES = 4;
    const EDIT_CATEGORIES = 8;
    const EDIT_USER_ACCESS = 16;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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

    public function canDo(string $perm) : bool
    {
        switch ($perm) {
            case 'post':
                return $this->checkPermission(self::ADD_POSTS);
            case 'del_post':
                    return $this->checkPermission(self::DELETE_POSTS);
            case 'add_ctg':
                return $this->checkPermission(self::ADD_CATEGORIES);
            case 'edit_ctg':
                return $this->checkPermission(self::EDIT_CATEGORIES);
            case 'edit_access':
                return $this->checkPermission(self::EDIT_USER_ACCESS);
            default:
                return false;
        }
    }

    protected function checkPermission(
        int $user_Permission = self::ADD_POSTS
    ) : bool {
        return !!($this->perm & $user_Permission);
    }
}
