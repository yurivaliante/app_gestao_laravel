<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SiteContato;
use App\MotivoContato;

class ContatoController extends Controller
{
    public function contato(Request $request){

        $motivo_contatos= MotivoContato::all();


      //var_dump($_POST);
      //dd($request);
/*
    echo '<pre>';
         print_r($request->all());
    echo '</pre>';

    echo $request->input('nome');
    echo '<br>';
    echo $request->input('email');

        $contato= new SiteContato();
        $contato->nome= $request->input('nome');
        $contato->telefone= $request->input('telefone');
        $contato->email= $request->input('email');
        $contato->motivo_contato= $request->input('motivo_contato');
        $contato->mensagem= $request->input('mensagem');


        $contato= new SiteContato();
        $contato-> fill($request->all());

      //  print_r($contato->getAttributes());
        $contato->save();
  */


       return view('site.contato', ['titulo'=>'Contato(Teste)', 'motivo_contatos'=>$motivo_contatos]);
    }

    public function salvar(Request $request){
        //REalizar a validação dos dados do formulário recebidos no request
        $regras=[
            'nome'=> 'required|min:3|max:40|unique:site_contatos',
            'telefone'=>'required',
            'email'=>'email',
            'motivo_contatos_id'=>'required',
            'telefone'=>'required',
            'mensagem'=>'required|max:2000'
        ];
        //Traduzindo as mensagens de errro
        $feedback=[
            'nome.min'=> 'O campo nome precisa ter no mínimo 3 caracteres',
            'nome.max'=> 'O campo nome precisa ter no maximo 40 caracteres',
            'nome.unique'=> 'O nome informado já está em uso',

            'email.email'=> 'O email informado não é válido',
            'mensagem.max'=> 'A mensagem  deve ter no máximo 2000 caracteres',

            'required'=> 'O campo :attribute deve ser preenchido'
        ];

        $request->validate($regras, $feedback);
        SiteContato::create($request->all());
        return redirect()->route('site.index');


    }
}
