<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Sep\Sep;

class SepController extends Controller
{
    protected $conn;

    public function __construct()
    {
        $this->conn = new Sep();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report.sep.index');
    }

    public function cariSep(Request $request)
    {
        if ($request->ajax()) 
        {
            $output = '';
            $cariSep = $this->conn->cariSep($request->no_sep);
            $decSep = json_decode($cariSep);
            if ($decSep->response != null)
            {
                $url = action('SepController@deleteSep',$decSep->response->noSep);
                $token = $request->session()->token();
                $output = 
                '<tr>'. 
                    '<td>'.$decSep->response->peserta->noMr.'</td>'.
                    '<td>'.$decSep->response->noSep.'</td>'.
                    '<td>'.$decSep->response->peserta->nama.'</td>'.
                    '<td>'.$decSep->response->poli.'</td>'.
                    '<td>'.$decSep->response->peserta->jnsPeserta.'</td>'.
                    '<td>
                        <form id="delete-sep" action="'.$url.'" method="POST">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" value="'.$token.'">
                            <input type="submit" value="delete">
                        </form>
                    </td>'.
                '</tr>';
            } else {
                $output = '<tr>'.'<td colspan="6"><center>'.$decSep->metaData->message.'</center></td>'.'</tr>';
            }
            return response($output);
        }
        
    }

    public function deleteSep($no_sep)
    {
        $data = $this->remap($no_sep);
        $deleteSep = $this->conn->deleteSep($data);
        return redirect()->route('sep.index')->with('message', 'berhasil di hapus!');
    }

    public function remap($no_sep)
    {
        $data['noSep'] = $no_sep;
        $data['user'] = 'Admin';
        $t_sep['t_sep'] = $data;
        $r['request'] = $t_sep;
        return json_encode($r);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
