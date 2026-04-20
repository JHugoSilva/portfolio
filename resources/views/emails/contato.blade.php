<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        /* Estilos inline são melhores para e-mail, mas aqui ficam os gerais */
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #333; line-height: 1.6; }
        .container { width: 100%; max-width: 600px; margin: 0 auto; border: 1px solid #eee; }
        .header { background-color: #f9f9f9; padding: 20px; text-align: center; }
        .content { padding: 30px; }
        .button {
            background-color: #6e57e0; /* Cor padrão de muitos portfólios */
            color: #ffffff !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            font-weight: bold;
        }
        .footer { background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px; }
        .social-icons img { width: 24px; margin: 0 10px; }
        img.profile { border-radius: 10px; max-width: 200px; height: auto; }
    </style>
</head>
<body>
    <div class="container">
       <div style="font-family: sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #eee;">

    <div class="header" style="background-color: #f9f9f9; padding: 20px; text-align: center;">
        @if(isset($about['home_image']))
            <img src="{{ $about['home_image'] }}" alt="Profile" style="border-radius: 10px; max-width: 150px;">
        @endif
    </div>

    <div class="content" style="padding: 30px;">
        <h1 style="margin-top: 0; color: #333;">Olá Hugo, o {{ $contact->nome }} enviou uma mensagem!</h1>

        <h3 style="color: #6e57e0; margin-bottom: 5px;">Assunto: {{ $contact->assunto }}</h3>

        <div style="background: #f4f4f4; padding: 15px; border-radius: 5px; margin-top: 20px;">
            <p style="margin: 0;"><strong>E-mail do remetente:</strong> {{ $contact->email }}</p>
            @if($contact->telefone)
                <p style="margin: 5px 0;"><strong>Telefone:</strong> {{ $contact->telefone }}</p>
            @endif
            <hr style="border: 0; border-top: 1px solid #ddd; margin: 15px 0;">
            <p style="white-space: pre-line;">{{ $contact->mensagem }}</p>
        </div>

        <div style="margin: 30px 0; text-align: center;">
            <a href="mailto:{{ $contact->email }}"
               style="background-color: #6e57e0; color: #ffffff; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">
               Responder para {{ $contact->nome }}
            </a>
        </div>
    </div>

    <div class="footer" style="background-color: #f4f4f4; padding: 20px; text-align: center; font-size: 12px;">
        <p style="margin-bottom: 10px;">Minhas redes sociais:</p>
        <div class="social-icons">
            @foreach($medias as $media)
                <a href="{{ $media['link'] }}" style="text-decoration: none; margin: 0 8px;">
                    <span style="color: #6e57e0; font-weight: bold;">
                        {{ ucfirst($media['icon']) }}
                    </span>
                </a>
            @endforeach
        </div>
        <p style="margin-top: 20px; color: #999;">
            &copy; {{ date('Y') }} {{ $about['name'] ?? 'Hugo Silva' }}. Todos os direitos reservados.
        </p>
    </div>
</div>
    </div>
</body>
</html>
