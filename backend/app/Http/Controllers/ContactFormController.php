<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Models\ContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $contactForms = ContactForm::all();
        dump($contactForms);
        return view('contact.index', compact('contactForms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // DB保存するためにインスタンス作成
        $contactF = new ContactForm;

        // $request->all()でも全ての要素をしゅとくできるがtokenも入ってしまう...
        $contactF->your_name = $request->input('your_name');
        $contactF->title = $request->input('title');
        $contactF->email = $request->input('email');
        $contactF->url = $request->input('url');
        $contactF->gender = $request->input('gender');
        $contactF->age = $request->input('age');
        $contactF->contact = $request->input('contact');

        $contactF->save();
        return redirect('contact/index');
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

    public function DLCsv(Request $request)
    {
        // dd($request->contactForms123);
        // 

        // データの作成
        // $contactForms = $request->contactForms;
        // dd($contactForms);
        $users = [
            ['id' => '太郎', 'your_name' => 24],
            ['name' => '花子', 'age' => 21]
        ];
        // カラムの作成
        $head = ['id', 'your_name'];

        // 書き込み用ファイルを開く
        $f = fopen('test.csv', 'w');
        if ($f) {
            // カラムの書き込み
            mb_convert_variables('SJIS', 'UTF-8', $head);
            fputcsv($f, $head);
            // データの書き込み
            foreach ($users as $user) {
                mb_convert_variables('SJIS', 'UTF-8', $user);
                fputcsv($f, $user);
            }
        }
        // ファイルを閉じる
        fclose($f);

        // HTTPヘッダ
        header("Content-Type: application/octet-stream");
        header('Content-Length: ' . filesize('test.csv'));
        header('Content-Disposition: attachment; filename=test.csv');
        readfile('test.csv');
        return redirect('contact/index');
    }
}
