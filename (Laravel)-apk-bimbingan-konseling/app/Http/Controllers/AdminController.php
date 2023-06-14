<?php

namespace App\Http\Controllers;

use App\Exports\GuruExport;
use App\Exports\KelasExport;
use App\Exports\PetaKerawananExport;
use App\Exports\SiswaExport;
use App\Exports\WalasExport;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Konseling_bk;
use App\Models\PetaKerawanan;
use App\Models\Siswa;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function profileAdmin(){
        $walikelas = WaliKelas::all();
        $guru = Guru::all();
        $siswa = Siswa::all();
        $jadwal = Konseling_bk::all();

        return view('admin.profileAdmin', compact('walikelas', 'guru', 'siswa', 'jadwal'));
    }

    ///////////////////////////////////////siswa start///////////////////////////////////////
    public function Siswa(){
        $data = Siswa::with('kelas')->paginate();
        return view('admin.datasiswa', compact('data'));
    }

    public function tambahdatasiswa(){
        $data = Kelas::all();
        return view('admin.tambahsiswa',compact('data'));
    }

    public function insertSiswa(Request $request){
        $data = [
            'name' => $request->input('namasiswa'),
            'nisn_nip' => $request->input('nisn'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'siswa'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);

        // Membuat objek Siswa dengan ID baru
        $siswa = new Siswa();
        $siswa->user_id = $dataid;
        $siswa->namasiswa = $request->input('namasiswa');
        $siswa->foto = '';

        // Mengunggah foto siswa jika tersedia
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotosiswa/', $request->file('foto')->getClientOriginalName());
            $siswa->foto = $request->file('foto')->getClientOriginalName();
        }

        $siswa->jeniskelamin = $request->input('jeniskelamin');
        $siswa->tempatlahir = $request->input('tempatlahir');
        $siswa->tanggallahir = $request->input('tanggallahir');
        $siswa->kelas_id = $request->input('kelas_id');
        $siswa->save();
        
        return redirect()->route('Siswa');
    }


    public function DeleteSiswa($id){
        $data = Siswa::find($id);
    
        // Menghapus foto jika ada
        if ($data->foto) {
            $filePath = public_path('fotosiswa/' . $data->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        // Hapus data di tabel User
        $user = User::find($data->user_id);
        if ($user) {
            $user->delete();
        }
    
        // Hapus data di tabel Siswa
        $data->delete();
    
        return redirect()->route('Siswa');
    }
    

    public function TampilkanSiswa($id){
        $data = Siswa::with('user')->find($id);
        $datakelas = kelas::all();

        return view('admin.EditSiswa', compact('data','datakelas'));
    }
    
    public function UpdateSiswa(Request $request, $id){
        $data = Siswa::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya

        // Update data siswa
        $data->namasiswa = $request->input('namasiswa');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->kelas_id = $request->input('kelas_id');
        $data->save();

        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotosiswa/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }

            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotosiswa/', $fotoName);

            // Update foto siswa
            $data->foto = $fotoName;
            $data->save();
        }

        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namasiswa');
            $user->nisn_nip = $request->input('nisn');
            $user->save();
        }

        return redirect()->route('Siswa');
    }
    ///////////////////////////////////////siswa end/////////////////////////////////////////

    ///////////////////////////////////////kelas start///////////////////////////////////////
    public function kelas(){
        $data = Kelas::with('guru','walikelas')->paginate();
        return view('admin.kelas', compact('data'));
    }

    public function tambahkelas(){
        $dataguru = Guru::all();
        $datawalikelas = WaliKelas::all();
        return view('admin.tambahkelas', compact('dataguru','datawalikelas'));
    }

    public function insertKelas(Request $request){
        Kelas::create($request->all());
        return redirect()->route('kelas');
    }

    public function DeleteKelas($id){
        $data = Kelas::find($id);        
        $data->delete();
        
        return redirect()->route('kelas');
    }
    ///////////////////////////////////////kelas end/////////////////////////////////////////

    ///////////////////////////////////////wali kelas start///////////////////////////////////////

    public function WaliKelas(){
        $data = WaliKelas::with('user')->paginate();
        return view('admin.dataWaliKelas',compact('data'));
    }

    public function TambahWaliKelas(){
        return view('admin.tambahwalikelas');
    }

    public function InsertWaliKelas(Request $request){
        // dd($request->all());
        $data = [
            'name' => $request->input('namagurukelas'),
            'nisn_nip' => $request->input('nip'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'wali_kelas'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);
        
        // Membuat objek walikelas dengan ID baru
        $walikelas = new WaliKelas();
        $walikelas->user_id = $dataid;
        $walikelas->namagurukelas = $request->input('namagurukelas');
        $walikelas->foto = '';
        
        // Mengunggah foto walikelas jika tersedia
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotowalikelas/', $request->file('foto')->getClientOriginalName());
            $walikelas->foto = $request->file('foto')->getClientOriginalName();
        }
        
        $walikelas->jeniskelamin = $request->input('jeniskelamin');
        $walikelas->tempatlahir = $request->input('tempatlahir');
        $walikelas->tanggallahir = $request->input('tanggallahir');
        $walikelas->save();
        
        return redirect()->route('WaliKelas');
        
    }

    public function TampilkanWaliKelas($id){
        $data = WaliKelas::with('user')->find($id);
        // dd($data);
        return view('admin.EditWaliKelas', compact('data'));
    }

    public function UpdateWaliKelas(Request $request, $id){
        $data = WaliKelas::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data walikelas
        $data->namagurukelas = $request->input('namagurukelas');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotowalikelas/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotowalikelas/', $fotoName);
    
            // Update foto walikelas
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namagurukelas');
            $user->nisn_nip = $request->input('nip');
            $user->save();
        }
    
        return redirect()->route('WaliKelas');
    }

    public function DeleteWaliKelas($id){
        $walikelas = WaliKelas::find($id);
    
        // Menghapus foto jika ada
        if ($walikelas->foto) {
            $filePath = public_path('fotowalikelas/' . $walikelas->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        // Menghapus data di tabel User
        $user = User::find($walikelas->user_id);
        if ($user) {
            $user->delete();
        }
    
        // Menghapus data di tabel walikelas
        $walikelas->delete();
    
        return redirect()->route('WaliKelas');
    }
    ///////////////////////////////////////wali kelas end/////////////////////////////////////////


    ///////////////////////////////////////guru start///////////////////////////////////////
    public function Guru(){
        $data = Guru::with('user')->paginate();
        return view('admin.dataGuru', compact('data'));
    }
    
    public function tambahdataguru(){
        return view('admin.tambahguru');
    }

    public function insertGuru(Request $request){
        $data = [
            'name' => $request->input('namaguru'),
            'nisn_nip' => $request->input('nip'),        
            'password' => Hash::make($request->input('password')),
            'level' => 'guru'
        ];
        
        $dataid = DB::table('users')->insertGetId($data);
        
        // Membuat objek Guru dengan ID baru
        $guru = new Guru();
        $guru->user_id = $dataid;
        $guru->namaguru = $request->input('namaguru');
        $guru->foto = '';
        
        // Mengunggah foto guru jika tersedia
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotoguru/', $request->file('foto')->getClientOriginalName());
            $guru->foto = $request->file('foto')->getClientOriginalName();
        }
        
        $guru->jeniskelamin = $request->input('jeniskelamin');
        $guru->tempatlahir = $request->input('tempatlahir');
        $guru->tanggallahir = $request->input('tanggallahir');
        $guru->save();
        
        return redirect()->route('Guru');
        
    }

    public function TampilkanGuru($id){
        $data = Guru::with('user')->find($id);
        return view('admin.EditGuru', compact('data'));
    }

    public function UpdateGuru(Request $request, $id){
        $data = Guru::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data guru
        $data->namaguru = $request->input('namaguru');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotoguru/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotoguru/', $fotoName);
    
            // Update foto guru
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namaguru');
            $user->nisn_nip = $request->input('nip');
            $user->save();
        }
    
        return redirect()->route('Guru');
    }
    

    public function DeleteGuru($id){
        $guru = Guru::find($id);
    
        // Menghapus foto jika ada
        if ($guru->foto) {
            $filePath = public_path('fotoguru/' . $guru->foto);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    
        // Menghapus data di tabel User
        $user = User::find($guru->user_id);
        if ($user) {
            $user->delete();
        }
    
        // Menghapus data di tabel Guru
        $guru->delete();
    
        return redirect()->route('Guru');
    }
    ///////////////////////////////////////guru end///////////////////////////////////////

    /////////////////////////////////////ExportExcel////////////////////////////////
    public function exportguru()
    {
        return Excel::download(new GuruExport, 'Guru.xlsx');
    }

    public function exportwalas()
    {
        return Excel::download(new WalasExport, 'akunwalas.xlsx');
    }
    public function exportkelas()
    {
        return Excel::download(new KelasExport, 'Kelas.xlsx');
    }
    public function exportsiswa()
    {
        return Excel::download(new SiswaExport, 'akunsiswa.xlsx');
    }
    public function exportpetakerawanan()
    {
        return Excel::download(new PetaKerawananExport, 'akunpetakerawanan.xlsx');
    }

    ////////////////////////endExport//////////////////////////////////

    ////////////////////////////////////petakerawanan///////////////////////////////////////////
    public function Petakerawanan(){
        $data = PetaKerawanan::all();
        return view('admin.petakerawanan', compact('data'));
    }

    public function tambahpelanggaran(){
        return view('admin.tambahpetakerawanan');
    }

    public function insertpetaadmin(Request $request){
        $data = PetaKerawanan::create($request->all());
        return redirect('/Admin/DataKerawan');
    }
    public function deletepetakerawanan($id){
        $data = PetaKerawanan::find($id);
        $data->delete();
        return redirect('/Admin/DataKerawan')->with('sucess', 'data berhasil diapus');
    }

}
