<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API de Gerenciamento de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="mb-6">
                    <svg class="h-16 w-16 text-blue-600 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Bem-vindo à API de Usuários</h1>
                
                <p class="text-lg text-gray-600 mb-8">
                    Esta API RESTful permite gerenciar usuários com operações completas de CRUD (Create, Read, Update, Delete). 
                    Desenvolvida em PHP com Laravel.
                </p>
                
                <a href="{{ url('/api/documentation') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Acessar Documentação
                </a>
            </div>
        </div>
    </div>
</body>
</html>