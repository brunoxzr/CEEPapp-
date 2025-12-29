<?php

use App\Models\Admin;

if (!function_exists('adminPode')) {
    function adminPode(string $permissao): bool
    {
        if (!session('admin_id')) {
            return false;
        }

        $admin = Admin::find(session('admin_id'));

        if (!$admin) {
            return false;
        }

        // Diretor é master
        if ($admin->role === 'diretor') {
            return true;
        }

        return $admin->permissoes()
            ->where('chave', $permissao)
            ->exists();
    }
}
