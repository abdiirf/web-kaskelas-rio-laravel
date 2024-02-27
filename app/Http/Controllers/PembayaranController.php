<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayarans = Pembayaran::selectRaw('id_siswa, SUM(jumlah_bayar) as jumlah_bayar, MAX(tgl_bayar) as tgl_bayar, MAX(id) as id')
        ->groupBy('id_siswa')
        ->orderBy('tgl_bayar', 'desc')
        ->paginate(1);


        return view('pembayaran.index', compact('pembayarans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Siswa::all();
        return view('pembayaran.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Validate form
            $this->validate($request, [
                'id_siswa' => 'required',
                'tgl_bayar' => 'required',
                'jumlah_bayar' => 'required',
            ]);

            // Create pembayaran
            Pembayaran::create([
                'id_siswa' => $request->id_siswa,
                'tgl_bayar' => $request->tgl_bayar,
                'jumlah_bayar' => $request->jumlah_bayar,
            ]);

            return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Disimpan!']);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Ambil data pembayaran berdasarkan $id
        $data = Pembayaran::find($id);

        // Ganti ini dengan cara mendapatkan data siswa sesuai dengan kebutuhan
        $siswah = Siswa::all();

        return view('pembayaran.edit', ['siswah' => $siswah, 'data' => $data]);
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        try {
        // Validate form
        $this->validate($request, [
            'id_siswa' => 'required',
            'tgl_bayar' => 'required',
            'jumlah_bayar' => 'required',
        ]);

        // Update siswa
        $pembayaran->update([
            'id_siswa' => $request->id_siswa,
            'tgl_bayar' => $request->tgl_bayar,
            'jumlah_bayar' => $request->jumlah_bayar,
        ]);

        // Redirect to index
        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Diubah!']);
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {

        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }

    public function showHistory($id)
    {
        $currentPayment = Pembayaran::findOrFail($id);
        $idSiswa = $currentPayment->id_siswa;

        $history = Pembayaran::where('id_siswa', $idSiswa)
                            ->where('tgl_bayar', '<', $currentPayment->tgl_bayar)
                            ->paginate(4);

        return view('pembayaran.history', ['history' => $history]);
    }
}
