<?php

namespace App\Http\Controllers;

use App\Events\EmailContact;
use App\Models\Contact;
use Exception;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function enviarEmail(Request $request)
    {
        // 1. Validar os dados que chegam da API ou Formulário
        $dados = $request->validate([
            'nome'     => 'required|string|max:255',
            'email'    => 'required|email',
            'assunto'  => 'required|string|max:150',
            'mensagem' => 'required|string',
        ]);

        // 2. Dados do teu layout (geralmente vêm da BD ou config)
        $about = [
            'name'        => 'Hugo Silva',
            'tagline'     => 'Desenvolvedor Full Stack',
            'description' => 'Apaixonado por criar soluções web incríveis.',
            'home_image'  => 'https://avatars.githubusercontent.com/u/16260996?v=4'
        ];

        $medias = [
            ['link' => 'https://github.com/JHugoSilva', 'icon' => 'github'],
            ['link' => 'https://www.linkedin.com/in/hugo-silva-b9a666118', 'icon' => 'linkedin']
        ];

        try {

            $contact = Contact::create($dados);
            event(new EmailContact($contact, $about, $medias));
            // 3. Resposta de sucesso (formato JSON para APIs)
            return response()->json([
                'status'  => 'sucesso',
                'message' => 'E-mail enviado com sucesso para a nossa equipa!'
            ], 200);
        } catch (Exception $e) {
            // 4. Tratamento de erro caso o servidor de e-mail falhe
            return response()->json([
                'status'  => 'erro',
                'message' => 'Falha ao enviar e-mail.',
                'debug'   => $e->getMessage() // Opcional: apenas para desenvolvimento
            ], 500);
        }
    }
}
