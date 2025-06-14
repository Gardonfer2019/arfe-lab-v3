<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\Navigation\NavigationGroup;
use BezhanSalleh\FilamentShield\Resources\RoleResource;
use BezhanSalleh\FilamentShield\Resources\PermissionResource;

class LaboratorioPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('laboratorio')
            ->path('laboratorio')
            ->login()
            ->colors([
                'primary' => Color::Indigo,
            ])
            ->favicon(asset('images/microscope.png'))
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->navigationGroups([
                // Segunda Sección: Pacientes
                NavigationGroup::make()
                    ->label('Gestión de Pacientes')
                    ->items([
                        \App\Filament\Resources\PacienteResource::class,
                    ]),
                
                // Primera Sección: Gestión de Exámenes
                NavigationGroup::make()
                    ->label('Gestión de Exámenes')
                    ->items([
                        \App\Filament\Resources\ExamenResource::class,
                        \App\Filament\Resources\ComponentesExamenResource::class,
                        \App\Filament\Resources\ResultadoExamenResource::class,
                        \App\Filament\Resources\SerieResource::class,
                    ]),

                

                // Tercera Sección: Solicitudes
                NavigationGroup::make()
                    ->label('Solicitudes')
                    ->items([
                        \App\Filament\Resources\SolicitudExamenResource::class,
                    ]),
                // Configuración del sistema: Usuarios
                NavigationGroup::make()
                    ->label('Configuración del Sistema')
                    ->items([
                        \App\Filament\Resources\UserResource::class,
                        RoleResource::class,  // Agrega el recurso de Roles
                        PermissionResource::class, // Agrega el recurso de Permisos
                    ]),
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make()
            ]);
    }
}
