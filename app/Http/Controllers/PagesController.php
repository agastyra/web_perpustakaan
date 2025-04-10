<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class PagesController extends Controller
{
    public function loginPage()
    {
        return view('public.login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'user_username' => ['required'],
            'user_password' => ['required'],
        ]);

        $user = User::where('user_username', $request->user_username)
            ->first();

        if (!$user || !Hash::check($request->user_password, $user->user_password)) {
            return back()->withErrors([
                'user_username' => 'The provided credentials do not match our records.',
            ])->onlyInput('user_username');
        }

        Auth::loginUsingId($user->id);
        Log::info('User '. $user->user_nama . ' has logged into the application');
        $request->session()->regenerate();

        if ($user->user_level == 'admin') {
            return redirect()->intended('/admin');
        }

        return redirect()->intended('/siswa');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function registerPage()
    {
        return view('public.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            "user_name" => ["required"],
            "user_email" => ["required", "email", "unique:users,user_email"],
            "user_username" => ["required", "unique:users,user_username"],
            "user_password" => ["required"],
            "user_password_confirmation" => ["required"]
        ]);
        if ($request->input("user_password") !== $request->input("user_password_confirmation")) {
            return back()->withErrors([
                'user_password' => 'Password and confirmation password do not match',
            ]);
        }
        unset($data["user_password_confirmation"]);
        try {
            $data["user_password"] = Hash::make($request->input("user_password"));
            $user = User::register($data);
            Auth::loginUsingId($user->id);

            if ($user->user_level == 'admin') {
                return redirect()->intended('/admin');
            }

            return redirect()->intended('/siswa');
        } catch (\Exception $exception) {
            return redirect()->route('register')->with(["deleted" => "Something went wrong. Please try again later"]);
        }
    }
    public function dashboardSiswa()
    {
        return view('siswa.dashboard', ['level' => 'siswa']);
    }
    public function dashboardAdmin()
    {
        return view('admin.dashboard', ['level' => 'admin']);
    }
    // {
    //     return view('admin.dashboard');
    // }
    // {
    //     return view('admin.dashboard', ['nama' => 'Rachel Sulastri']);
    // }

    //{
    //     $data = [
    //         [
    //             'nama' => 'Zakir Adit',
    //             'kelas' => '1A'
    //         ],
    //         [
    //             'nama' => 'Bayu Aji',
    //             'kelas' => '2A'
    //         ],
    //     ];
    //     return view('admin.dashboard')->with('data', $data);
    // }
    public function adminBuku()
    {
        return view('admin.admin_buku', ['level' => 'admin']);
    }
    public function siswaBuku()
    {
        $buku = Buku::readBuku();
        return view('siswa.siswa_buku', ['level' => 'siswa', 'buku' => $buku]);
    }
    public function createBuku()
    {
        return view('admin.admin_create', ['level' => 'admin']);
    }
    public function updateBuku()
    {
        return view('admin.admin_update_buku', ['level' => 'admin']);
    }
    public function kategoriBuku()
    {
        return view('admin.admin_kategori', ['level' => 'admin']);
    }
    public function createkategoriBuku()
    {
        return view('admin.admin_create_kategori', ['level' => 'admin']);
    }
    public function kategoriupdateBuku()
    {
        return view('admin.admin_update_kategori', ['level' => 'admin']);
    }
    public function createPenulis()
    {
        return view('admin.admin_create_penulis', ['level' => 'admin']);
    }
    public function penulis()
    {
        return view('admin.admin_penulis', ['level' => 'admin']);
    }
    public function updatePenulis()
    {
        return view('admin.admin_update_penulis', ['level' => 'admin']);
    }
    public function penerbit()
    {
        return view('admin.admin_penerbit', ['level' => 'admin']);
    }
    // public function createPenerbit()
    // {
    //     return view('admin.admin_create_penerbit', ['level' => 'admin']);
    // }
    public function updatePenerbit()
    {
        return view('admin.admin_update_penerbit', ['level' => 'admin']);
    }
    public function adminPeminjaman()
    {
        $peminjaman = Peminjaman::with('detail.buku', 'user')
            ->paginate(10);
        return view('admin.admin_peminjaman', ['level' => 'admin', 'peminjaman' => $peminjaman]);
    }
    public function siswaPeminjaman()
    {
        $peminjaman = Peminjaman::where('peminjaman_user_id', Auth::user()->id)
            ->with('detail.buku')
            ->paginate(10);
        return view('siswa.siswa_peminjaman', ['level' => 'siswa', 'peminjaman' => $peminjaman]);
    }
    public function adminupdatePeminjaman(Request $request, $id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->with('detail.buku.penulis', 'detail.buku.penerbit', 'user')
            ->first();
        $siswa = User::where('user_level', 'anggota')
            ->orderBy('user_name')
            ->get();
        $allBuku = Buku::orderBy('buku_isbn')->get();

        $peminjamanDetail = [];
        foreach ($peminjaman->detail as $detail) {
            $peminjamanDetail[] = $detail->buku->toArray();
        }

        return view('admin.admin_update_peminjaman', [
            'level' => 'admin',
            'peminjaman' => $peminjaman,
            'peminjaman_detail' => $peminjamanDetail,
            'siswa' => $siswa,
            'allBuku' => $allBuku,
        ]);
    }
    public function siswacreatePeminjaman()
    {
        $allBuku = Buku::orderBy('buku_isbn')->get();
        return view('siswa.siswa_create_peminjaman', ['level' => 'siswa', 'allBuku' => $allBuku]);
    }
    public function adminPengaturan()
    {
        $user = Auth::user();
        return view('admin.admin_pengaturan', ['level' => 'admin', 'user' => $user]);
    }
    public function pengaturan()
    {
        $user = Auth::user();
        return view('pengaturan', ['user' => $user]);
    }

    public function updateSiswaPengaturan(Request $request, $id)
    {
        $data = $request->validate([
            'user_name' => 'required',
            'user_email' => ['required', 'email:dns', 'unique:users,user_email,' . $id],
            'user_username' => 'required',
            'user_alamat' => 'required',
            'user_notelp' => ['required', 'unique:users,user_notelp,' . $id],
        ]);

        if (!is_null($request->user_password)) {
            $data['user_password'] = Hash::make($request->user_password);
            $user = User::find($id);
            $user->update($data);
            return redirect()->route('pengaturan')->with('success', 'Data berhasil diperbarui.');
        }
        
        $user = User::find($id);
        $user->update([
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'user_username' => $request->user_username,
            'user_alamat' => $request->user_alamat,
            'user_notelp' => $request->user_notelp
        ]);
        return redirect()->route('pengaturan')->with('success', 'Data berhasil diperbarui.');
    }

    public function upload_profile (Request $request, $id)
    {
        if ($request->hasFile('profile')) {
            $request->validate([
                'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=200,min_height=200,max_width=200,max_height=200',
            ]);
            $data = $request->file('profile');
            User::upload_profile($id, $data);
            return redirect()->route('pengaturan')->with('success', 'Foto profil berhasil diperbarui!');
        }
        return back()->with('failed', 'Foto profil gagal diperbarui!');
    }

    // public function update_penerbit ($id) {
    //     $penerbit = Penerbit::readPenerbitById($id);

    //     return view('actions.penerbit.update_penerbit', ['level' => 'admin'])->with('p
    //     enerbit', $penerbit);
    //     }

    public function adminRak()
    {
        return view('admin.rak', ['level' => 'admin']);
    }
    public function admincreateRak()
    {
        return view('admin.admin_create_rak', ['level' => 'admin']);
    }
    public function adminupdateRak()
    {
        return view('admin.admin_update_rak', ['level' => 'admin']);
    }
    public function adminpeminjamandetail()
    {
        return view('admin.admin_detail_peminjaman', ['level' => 'admin']);
    }
    public function siswapeminjamandetail()
    {
        return view('siswa.siswa_detail_peminjaman', ['level' => 'siswa']);
    }
}
