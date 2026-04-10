<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class BaseController extends Controller
{
    protected function safeDelete($model, $id, $message = null)
    {
        try {
            $data = $model::findOrFail($id);
            $data->delete();

            return back()->with('success', 'Data berhasil dihapus');
        } catch (QueryException $e) {

            // error foreign key
            if ($e->getCode() == "23000") {
                return back()->with(
                    'error',
                    $message ?? 'Data tidak bisa dihapus karena masih digunakan!'
                );
            }

            return back()->with('error', 'Terjadi kesalahan saat menghapus data');
        }
    }
}
