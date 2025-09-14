<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    {{-- Page Title --}}
    <title>{{config('l5-swagger.documentations.'.$documentation.'.api.title')}}</title>
    
    {{-- External Stylesheets --}}
    <link rel="stylesheet" type="text/css" href="{{ l5_swagger_asset($documentation, 'swagger-ui.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/l5-swagger/custom.css') }}">
    
    {{-- Favicons --}}
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-32x32.png') }}" sizes="32x32"/>
    <link rel="icon" type="image/png" href="{{ l5_swagger_asset($documentation, 'favicon-16x16.png') }}" sizes="16x16"/>
    
    {{-- Base Styles --}}
    <style>
        /* Reset and base styles */
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        
        *,
        *:before,
        *:after {
            box-sizing: inherit;
        }

        body {
            margin: 0;
            background: #fafafa;
        }
    </style>
    {{-- Dark Mode Styles --}}
    @if(config('l5-swagger.defaults.ui.display.dark_mode'))
        <style>
            /* Dark mode base styles */
            body#dark-mode,
            #dark-mode .scheme-container {
                background: #1b1b1b;
            }
            
            /* Shadow effects */
            #dark-mode .scheme-container,
            #dark-mode .opblock .opblock-section-header {
                box-shadow: 0 1px 2px 0 rgba(255, 255, 255, 0.15);
            }
            
            /* Form inputs */
            #dark-mode .operation-filter-input,
            #dark-mode .dialog-ux .modal-ux,
            #dark-mode input[type=email],
            #dark-mode input[type=file],
            #dark-mode input[type=password],
            #dark-mode input[type=search],
            #dark-mode input[type=text],
            #dark-mode textarea {
                background: #343434;
                color: #e7e7e7;
            }
            
            /* General text elements */
            #dark-mode .title,
            #dark-mode li,
            #dark-mode p,
            #dark-mode table,
            #dark-mode label,
            #dark-mode .opblock-tag,
            #dark-mode .opblock .opblock-summary-operation-id,
            #dark-mode .opblock .opblock-summary-path,
            #dark-mode .opblock .opblock-summary-path__deprecated,
            #dark-mode h1,
            #dark-mode h2,
            #dark-mode h3,
            #dark-mode h4,
            #dark-mode h5,
            #dark-mode .btn,
            #dark-mode .tab li,
            #dark-mode .parameter__name,
            #dark-mode .parameter__type,
            #dark-mode .prop-format,
            #dark-mode .loading-container .loading:after {
                color: #e7e7e7;
            }
            
            /* Special text elements */
            #dark-mode .opblock-description-wrapper p,
            #dark-mode .opblock-external-docs-wrapper p,
            #dark-mode .opblock-title_normal p,
            #dark-mode .response-col_status,
            #dark-mode table thead tr td,
            #dark-mode table thead tr th,
            #dark-mode .response-col_links,
            #dark-mode .swagger-ui {
                color: wheat;
            }
            
            /* Muted text elements */
            #dark-mode .parameter__extension,
            #dark-mode .parameter__in,
            #dark-mode .model-title {
                color: #949494;
            }
            
            /* Table borders */
            #dark-mode table thead tr td,
            #dark-mode table thead tr th {
                border-color: rgba(120, 120, 120, .2);
            }
            
            /* Operation blocks */
            #dark-mode .opblock .opblock-section-header {
                background: transparent;
            }
            
            /* HTTP method colors */
            #dark-mode .opblock.opblock-post {
                background: rgba(73, 204, 144, .25);
            }
            
            #dark-mode .opblock.opblock-get {
                background: rgba(97, 175, 254, .25);
            }
            
            #dark-mode .opblock.opblock-put {
                background: rgba(252, 161, 48, .25);
            }
            
            #dark-mode .opblock.opblock-delete {
                background: rgba(249, 62, 62, .25);
            }
            
            /* Loading animation */
            #dark-mode .loading-container .loading:before {
                border-color: rgba(255, 255, 255, 10%);
                border-top-color: rgba(255, 255, 255, .6);
            }
            
            /* SVG icons */
            #dark-mode svg:not(:root) {
                fill: #e7e7e7;
            }
            
            /* Operation descriptions */
            #dark-mode .opblock-summary-description {
                color: #fafafa;
            }
        </style>
    @endif
</head>

<body @if(config('l5-swagger.defaults.ui.display.dark_mode')) id="dark-mode" @endif>
    {{-- Swagger UI Container --}}
    <div id="swagger-ui"></div>

    {{-- External JavaScript Libraries --}}
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-bundle.js') }}"></script>
    <script src="{{ l5_swagger_asset($documentation, 'swagger-ui-standalone-preset.js') }}"></script>
    
    {{-- PHP Configuration Block --}}
    @php
        // Swagger UI Configuration
        $swaggerConfig = [
            // Core URLs
            'url' => $urlToDocs,
            'configUrl' => $configUrl ?? null,
            'validatorUrl' => $validatorUrl ?? null,
            'oauth2RedirectUrl' => route('l5-swagger.'.$documentation.'.oauth2_callback', [], $useAbsolutePath),
            
            // Security
            'csrfToken' => csrf_token(),
            
            // UI Configuration
            'operationsSorter' => $operationsSorter ?? null,
            'docExpansion' => config('l5-swagger.defaults.ui.display.doc_expansion', 'none'),
            'filter' => config('l5-swagger.defaults.ui.display.filter', false),
            'persistAuthorization' => config('l5-swagger.defaults.ui.authorization.persist_authorization', false),
            
            // OAuth2 Configuration
            'usePkceWithAuthorizationCodeGrant' => (bool)config('l5-swagger.defaults.ui.authorization.oauth2.use_pkce_with_authorization_code_grant', false),
            'hasOAuth2' => in_array('oauth2', array_column(config('l5-swagger.defaults.securityDefinitions.securitySchemes'), 'type'))
        ];
    @endphp

    {{-- Configuration Transfer to JavaScript --}}
    <script>
        // Transfer PHP configuration to JavaScript global scope
        window.swaggerConfig = <?php echo json_encode($swaggerConfig); ?>;
    </script>

    {{-- Swagger UI Initialization --}}
    <script>
        /**
         * Initialize Swagger UI when the page loads
         * This function sets up the complete Swagger UI interface with all configurations
         */
        window.onload = function() {
            // Initialize Swagger UI Bundle with configuration
            const ui = SwaggerUIBundle({
                // Core configuration
                dom_id: '#swagger-ui',
                url: window.swaggerConfig.url,
                
                // Optional URLs
                configUrl: window.swaggerConfig.configUrl,
                validatorUrl: window.swaggerConfig.validatorUrl,
                oauth2RedirectUrl: window.swaggerConfig.oauth2RedirectUrl,
                
                // UI behavior
                operationsSorter: window.swaggerConfig.operationsSorter,
                docExpansion: window.swaggerConfig.docExpansion,
                deepLinking: true,
                filter: window.swaggerConfig.filter,
                persistAuthorization: window.swaggerConfig.persistAuthorization,
                
                // Layout and presentation
                layout: "StandaloneLayout",
                
                // Security: Add CSRF token to all requests
                requestInterceptor: function(request) {
                    request.headers['X-CSRF-TOKEN'] = window.swaggerConfig.csrfToken;
                    return request;
                },

                // UI presets and plugins
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],

                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ]
            });

            // Make UI instance globally available
            window.ui = ui;

            // Initialize OAuth2 if configured
            if (window.swaggerConfig.hasOAuth2) {
                ui.initOAuth({
                    usePkceWithAuthorizationCodeGrant: window.swaggerConfig.usePkceWithAuthorizationCodeGrant
                });
            }
        };
    </script>
</body>
</html>
