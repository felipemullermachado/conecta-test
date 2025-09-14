<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        // Se a requisição espera JSON (API), retorna resposta JSON padronizada
        if ($request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    /**
     * Handle API exceptions and return JSON responses
     *
     * @param Request $request
     * @param Throwable $e
     * @return JsonResponse
     */
    private function handleApiException(Request $request, Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'message' => 'Dados de entrada inválidos',
                'errors' => $e->errors()
            ], 422);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'message' => 'Recurso não encontrado'
            ], 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Endpoint não encontrado'
            ], 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'success' => false,
                'message' => 'Método HTTP não permitido'
            ], 405);
        }

        // Para outros erros em produção, não expor detalhes
        if (config('app.debug')) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno do servidor',
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }

        return response()->json([
            'success' => false,
            'message' => 'Erro interno do servidor'
        ], 500);
    }
}
