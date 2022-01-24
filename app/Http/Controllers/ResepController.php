<?php

namespace App\Http\Controllers;

use App\Models\Obatalkes;
use App\Models\Resep;
use App\Models\ResepDetail;
use App\Models\Signa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ResepController extends Controller
{
    private function obatalkes()
    {
        return Obatalkes::orderBy('obatalkes_nama', 'asc')->get();
    }

    public function signa()
    {
        return Signa::orderBy('signa_nama', 'asc')->get();
    }

    // -----------------------------------------------------------------

    public function index()
    {
        return view('resep.index', [
            'resep' => Resep::get()
        ]);
    }

    public function create()
    {
        return view('resep.form', [
            'urlStore'         => route('resep.store'),
            'selectNonRacikan' => route('resep.tambah.obat.non.racikan'),
            'selectRacikan'    => route('resep.tambah.obat.racikan'),
            'obatalkes'        => $this->obatalkes(),
            'signa'            => $this->signa()
        ]);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $model             = new Resep();
            $model->kode       = 'KD'.Carbon::now()->format('ymdHis');
            $model->created_by = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
            $model->save();

            foreach ($request->obat as $obat) {
                $modelDetail = new  ResepDetail();
                $modelDetail->resep_id     = $model->id;
                $modelDetail->tipe_obat    = $obat['tipe_obat'];
                $modelDetail->obatalkes_id = $obat['obatalkes_id'];
                $modelDetail->signa_id     = $obat['signa_id'];
                $modelDetail->qty          = $obat['qty'];
                $modelDetail->created_by   = auth()->user()->id;
                $modelDetail->updated_by   = auth()->user()->id;
                $modelDetail->save();
            }

            DB::commit();

            return response()->json($request->obat);
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    // -----------------------------------------------------------------

    public function tambahObatNonRacikan()
    {
        $html = view('resep.form-non-racikan', [
            'obatalkes' => $this->obatalkes(),
            'signa'     => $this->signa()
        ])->render();

        return response()->json($html);
    }

    public function tambahObatRacikan()
    {
        $html = view('resep.form-racikan', [
            'obatalkes' => $this->obatalkes(),
            'signa'     => $this->signa()
        ])->render();

        return response()->json($html);
    }
}
