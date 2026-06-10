<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['username', 'password', 'role', 'nama_lengkap', 'email', 'no_hp', 'alamat', 'is_delete'])]
#[Hidden(['password'])]
class Akun extends Authenticatable
{
    use Notifiable;

    /**
     * Arahkan ke nama tabel kustommu
     */
    protected $table = 'akun';

    /**
     * Get the password for the user.
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * Cek apakah akun ini sudah dihapus (soft delete)
     */
    public function scopeActive($query)
    {
        return $query->where('is_delete', false);
    }
}