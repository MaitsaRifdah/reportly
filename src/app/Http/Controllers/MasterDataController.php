<?php
namespace App\Http\Controllers;

use App\Models\Dinas;
use App\Models\KategoriFasilitas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MasterDataController extends Controller
{
    /* KATEGORI */
    public function kategoriIndex()
    {
        $kategori = KategoriFasilitas::with('dinasDefault')->get();
        $dinas    = Dinas::all();
        return view('admin.master_kategori', compact('kategori','dinas'));
    }
    public function kategoriStore(Request $request)
    {
        $data = $request->validate([
            'nama_kategori'   => 'required|string|max:100',
            'ikon'            => 'nullable|string|max:50',
            'dinas_default_id'=> 'nullable|exists:dinas,id',
        ]);
        KategoriFasilitas::create($data);
        return back()->with('success','Kategori ditambahkan.');
    }
    public function kategoriUpdate(Request $request, KategoriFasilitas $kategori)
    {
        $kategori->update($request->only(['nama_kategori','ikon','dinas_default_id']));
        return back()->with('success','Kategori diupdate.');
    }
    public function kategoriDestroy(KategoriFasilitas $kategori)
    {
        $kategori->delete();
        return back()->with('success','Kategori dihapus.');
    }

    /* DINAS */
    public function dinasIndex()
    {
        $dinas = Dinas::all();
        return view('admin.master_dinas', compact('dinas'));
    }
    public function dinasStore(Request $request)
    {
        $data = $request->validate([
            'nama_dinas'   => 'required|string|max:100',
            'deskripsi'    => 'nullable|string',
            'kontak_dinas' => 'required|string|max:50',
        ]);
        Dinas::create($data);
        return back()->with('success','Dinas ditambahkan.');
    }
    public function dinasUpdate(Request $request, Dinas $dinas)
    {
        $dinas->update($request->only(['nama_dinas','deskripsi','kontak_dinas']));
        return back()->with('success','Dinas diupdate.');
    }
    public function dinasDestroy(Dinas $dinas)
    {
        $dinas->delete();
        return back()->with('success','Dinas dihapus.');
    }

    /* USER (Petugas/Admin) */
    public function userIndex()
    {
        $users = User::orderBy('role')->get();
        $dinas = Dinas::all();
        return view('admin.master_user', compact('users','dinas'));
    }
    public function userStore(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:warga,petugas,admin',
            'dinas_id' => 'nullable|exists:dinas,id',
            'no_hp'    => 'nullable|string',
        ]);
        $data['password'] = Hash::make($data['password']);
        User::create($data);
        return back()->with('success','User dibuat.');
    }
    public function userDestroy(User $user)
    {
        $user->delete();
        return back()->with('success','User dihapus.');
    }
}